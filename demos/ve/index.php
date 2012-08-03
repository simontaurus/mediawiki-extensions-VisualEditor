<?php
/**
 * VisualEditor standalone demo
 *
 * @file
 * @ingroup Extensions
 * @copyright 2011-2012 VisualEditor Team and others; see AUTHORS.txt
 * @license The MIT License (MIT); see LICENSE.txt
 */

$path = dirname( __FILE__ ) . '/pages';
$pages = glob( $path . '/*.html' );
$page = current( $pages );
if ( isset( $_GET['page'] ) && in_array( $path . '/' . $_GET['page'] . '.html', $pages ) ) {
	$page =  $path . '/' . $_GET['page'] . '.html';
}
$html = '<div>' . file_get_contents( $page ) . '</div>';

?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8" />
		<title>VisualEditor Standalone Demo</title>
		<!-- ce -->
		<link rel="stylesheet" href="../../modules/ve/ce/styles/ve.ce.DocumentNode.css">
		<link rel="stylesheet" href="../../modules/ve/ce/styles/ve.ce.Node.css">
		<link rel="stylesheet" href="../../modules/ve/ce/styles/ve.ce.Surface.css">
		<!-- ui -->
		<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Context.css">
		<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Inspector.css">
		<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Menu.css">
		<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Surface.css">
		<link rel="stylesheet" href="../../modules/ve/ui/styles/ve.ui.Toolbar.css">
		<!-- demo -->
		<link rel="stylesheet" href="demo.css">
	</head>
	<body>
		<ul class="ve-demo-docs">
			<?php foreach( $pages as $page ): ?>
				<li>
					<a href="./?page=<?php echo basename( $page, '.html' ); ?>">
						<?php echo basename( $page, '.html' ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="ve-demo-content"></div>

		<!-- Rangy -->
		<script src="../../modules/rangy/rangy-core.js"></script>
		<script src="../../modules/rangy/rangy-position.js"></script>

		<!-- ve -->
		<script src="../../modules/jquery/jquery.js"></script>
		<script src="../../modules/jquery/jquery.json.js"></script>
		<script src="../../modules/ve/ve.js"></script>
		<script>
		<?php
			include( dirname( dirname( dirname( __FILE__ ) ) ) . '/VisualEditor.i18n.php' );
			echo 've.msg.messages = ' . json_encode( $messages['en'] );
		?>
		</script>
		<script src="../../modules/ve/ve.debug.js"></script>
		<script src="../../modules/ve/ve.EventEmitter.js"></script>
		<script src="../../modules/ve/ve.Factory.js"></script>
		<script src="../../modules/ve/ve.Position.js"></script>
		<script src="../../modules/ve/ve.Range.js"></script>
		<script src="../../modules/ve/ve.Node.js"></script>
		<script src="../../modules/ve/ve.BranchNode.js"></script>
		<script src="../../modules/ve/ve.LeafNode.js"></script>
		<script src="../../modules/ve/ve.Surface.js"></script>
		<script src="../../modules/ve/ve.Document.js"></script>

		<!-- dm -->
		<script src="../../modules/ve/dm/ve.dm.js"></script>
		<script src="../../modules/ve/dm/ve.dm.NodeFactory.js"></script>
		<script src="../../modules/ve/dm/ve.dm.AnnotationFactory.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Node.js"></script>
		<script src="../../modules/ve/dm/ve.dm.BranchNode.js"></script>
		<script src="../../modules/ve/dm/ve.dm.LeafNode.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Annotation.js"></script>
		<script src="../../modules/ve/dm/ve.dm.TransactionProcessor.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Transaction.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Surface.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Document.js"></script>
		<script src="../../modules/ve/dm/ve.dm.DocumentSynchronizer.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Transaction.js"></script>
		<script src="../../modules/ve/dm/ve.dm.TransactionProcessor.js"></script>
		<script src="../../modules/ve/dm/ve.dm.Converter.js"></script>

		<script src="../../modules/ve/dm/nodes/ve.dm.AlienInlineNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.AlienBlockNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DefinitionListItemNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DefinitionListNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.DocumentNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.HeadingNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ImageNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ListItemNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ListNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.ParagraphNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.PreformattedNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableCellNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableRowNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TableSectionNode.js"></script>
		<script src="../../modules/ve/dm/nodes/ve.dm.TextNode.js"></script>

		<script src="../../modules/ve/dm/annotations/ve.dm.LinkAnnotation.js"></script>
		<script src="../../modules/ve/dm/annotations/ve.dm.TextStyleAnnotation.js"></script>

		<!-- ce -->
		<script src="../../modules/ve/ce/ve.ce.js"></script>
		<script src="../../modules/ve/ce/ve.ce.NodeFactory.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Document.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Node.js"></script>
		<script src="../../modules/ve/ce/ve.ce.BranchNode.js"></script>
		<script src="../../modules/ve/ce/ve.ce.LeafNode.js"></script>
		<script src="../../modules/ve/ce/ve.ce.Surface.js"></script>

		<script src="../../modules/ve/ce/nodes/ve.ce.AlienInlineNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.AlienBlockNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DefinitionListItemNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DefinitionListNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.DocumentNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.HeadingNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ImageNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ListItemNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ListNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.ParagraphNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.PreformattedNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableCellNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableRowNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TableSectionNode.js"></script>
		<script src="../../modules/ve/ce/nodes/ve.ce.TextNode.js"></script>

		<!-- ui -->
		<script src="../../modules/ve/ui/ve.ui.js"></script>
		<script>
			ve.ui.stylesheetPath = '../../modules/ve/ui/styles/';
		</script>
		<script src="../../modules/ve/ui/ve.ui.Inspector.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Tool.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Toolbar.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Context.js"></script>
		<script src="../../modules/ve/ui/ve.ui.Menu.js"></script>

		<script src="../../modules/ve/ui/inspectors/ve.ui.LinkInspector.js"></script>

		<script src="../../modules/ve/ui/tools/ve.ui.ButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.AnnotationButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.ClearButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.HistoryButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.ListButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.IndentationButtonTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.DropdownTool.js"></script>
		<script src="../../modules/ve/ui/tools/ve.ui.FormatDropdownTool.js"></script>

		<!-- demo -->
		<script>
			$(document).ready( function() {
				new ve.Surface(
					$( '.ve-demo-content' ),
					$( <?php echo json_encode( $html ) ?> )[0]
				);
				$( '.ve-ce-documentNode' ).focus();
			} );
		</script>
	</body>
</html>
