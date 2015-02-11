<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Based on default template of Cake Software Foundation, Inc. (http://cakefoundation.org)
 * using Boostrap CSS classes.
 *
 * Copyright (c) 2015 Nelson Martell (http://nelson6e65.github.io/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2015 Nelson Martell (http://nelson6e65.github.io/)
 * @link          http://nelson6e65.github.io/pretty_cake/
 * @package       app.Console.Templates.pretty_cake.views
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!-- View baked using a 'pretty_cake' template (http://git.io/NtTU). -->

<?php
	$_isAdd = (strpos($action, 'add') !== false);
	$_isEdit = (strpos($action, 'edit') !== false);

	$_panel_class = 'panel-default';
	$_submitButtonText = 'Submit';

	if ($_isAdd) {
		$_submitButtonText = 'Create';
		$_panel_class = 'panel-primary';
	} elseif($_isEdit) {
		$_submitButtonText = 'Update';
		$_panel_class = 'panel-warning';
	}

?>
<h2><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h2>

<div id="<?php echo $pluralVar . '-' . $action; ?>" class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3>
	</div>

	<div class="panel-body" style="overflow: auto;">

<?php
	echo "<?php
	echo \$this->Form->create('{$modelClass}', array(
		'inputDefaults' => array(
			'label' => array('class' => 'control-label'),
			'div' => 'form-group',
			'class' => 'form-control',
		)
	)); ?>\n";
?>

	<fieldset>
<?php
	echo "\t<?php\n";
	foreach ($fields as $field) {
		if (strpos($action, 'add') !== false && $field === $primaryKey) {
			continue;
		} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
			echo "\t\t\techo \$this->Form->input('{$field}');\n";
		}
	}
	if (!empty($associations['hasAndBelongsToMany'])) {
		foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
			echo "\t\techo \$this->Form->input('{$assocName}');\n";
		}
	}
	echo "\t?>\n";
?>
	</fieldset>
<?php
	$_submitOptions = array(

	);
	echo "<?php
	echo \$this->Form->end(array(
		'label' => __('{$_submitButtonText}'),
		'div' => array(
			'class' => 'form-group'
		),
		'class' => 'btn btn-success'
	 ));
?>";
?>

	</div>

	<div class="panel-footer">
		<div class="btn-toolbar" role="toolbar">

			<div class="btn-group" role="group">
<?php
	echo "\t\t\t\t<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index'), array('class' => 'btn btn-primary')); ?>\n";

	if (strpos($action, 'add') === false) {
		echo "\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>\n";
	}



?>
			</div>

			<div class="btn-group dropup" role="group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php echo "<?php echo __('Related actions'); ?> <span class=\"caret\"></span>\n"; ?>
				</button>

				<ul class="dropdown-menu" role="menu">
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\t\t\t\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
				echo "\t\t\t\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
				$done[] = $details['controller'];
			}
		}
	}
?>
				</ul>
			</div>

		</div>



	</div>


</div>
