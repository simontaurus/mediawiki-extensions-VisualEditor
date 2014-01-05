/*!
 * VisualEditor UserInterface LinkInspector class.
 *
 * @copyright 2011-2014 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

/*global mw */

/**
 * MediaWiki link inspector.
 *
 * @class
 * @extends ve.ui.LinkInspector
 *
 * @constructor
 * @param {ve.ui.WindowSet} windowSet Window set this inspector is part of
 * @param {Object} [config] Configuration options
 */
ve.ui.MWLinkInspector = function VeUiMWLinkInspector( windowSet, config ) {
	// Parent constructor
	ve.ui.LinkInspector.call( this, windowSet, config );
};

/* Inheritance */

OO.inheritClass( ve.ui.MWLinkInspector, ve.ui.LinkInspector );

/* Static properties */

ve.ui.MWLinkInspector.static.name = 'link';

ve.ui.MWLinkInspector.static.modelClasses = [
	ve.dm.MWExternalLinkAnnotation,
	ve.dm.MWInternalLinkAnnotation,
	ve.dm.MWNumberedExternalLinkNode
];

ve.ui.MWLinkInspector.static.linkTargetInputWidget = ve.ui.MWLinkTargetInputWidget;

/* Methods */

/**
 * Gets an annotation object from a target.
 *
 * The type of link is automatically detected based on some crude heuristics.
 *
 * @method
 * @param {string} target Link target
 * @returns {ve.dm.MWInternalLinkAnnotation|ve.dm.MWExternalLinkAnnotation|null}
 */
ve.ui.MWLinkInspector.prototype.getAnnotationFromText = function ( target ) {
	var title = mw.Title.newFromText( target );

	// Figure out if this is an internal or external link
	if ( ve.init.platform.getExternalLinkUrlProtocolsRegExp().test( target ) ) {
		// External link
		return new ve.dm.MWExternalLinkAnnotation( {
			'type': 'link/mwExternal',
			'attributes': {
				'href': target
			}
		} );
	} else if ( title ) {
		// Internal link
		// TODO: In the longer term we'll want to have autocompletion and existence and validity
		// checks using AJAX

		if ( title.getNamespaceId() === 6 || title.getNamespaceId() === 14 ) {
			// File: or Category: link
			// We have to prepend a colon so this is interpreted as a link
			// rather than an image inclusion or categorization
			target = ':' + target;
		}

		return new ve.dm.MWInternalLinkAnnotation( {
			'type': 'link/mwInternal',
			'attributes': {
				'title': target,
				'normalizedTitle': ve.dm.MWInternalLinkAnnotation.static.normalizeTitle( target )
			}
		} );
	} else {
		// Doesn't look like an external link and mw.Title considered it an illegal value,
		// for an internal link.
		return null;
	}
};

/**
 * @inheritdoc
 */
ve.ui.MWLinkInspector.prototype.getNodeChanges = function () {
	var annotations, data,
		doc = this.linkNode.getDocument(),
		annotation = this.getAnnotation();
	if ( annotation instanceof ve.dm.MWInternalLinkAnnotation ) {
		// We're inspecting a numbered external link node and attempting to set its target
		// to an internal link. Replace the numbered link node with an internal link annotation,
		// with the link target as the text.
		annotations = doc.data.getAnnotationsFromOffset( this.linkNode.getOffset() ).clone();
		annotations.push( annotation );
		data = ve.splitClusters( annotation.getAttribute( 'title' ) );
		ve.dm.Document.static.addAnnotationsToData( data, annotations );
		return data;
	}
	// Parent method
	return ve.ui.LinkInspector.prototype.getNodeChanges.call( this );
};

/* Registration */

ve.ui.inspectorFactory.register( ve.ui.MWLinkInspector );
