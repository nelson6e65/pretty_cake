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
<!-- View baked using a 'pretty_cake' template: http://nelson6e65.github.io/pretty_cake -->
<h2><?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h2>

<div id="<?php echo $pluralVar; ?>-view" class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title"><?php echo "<?php echo __('{$singularHumanName}' . ' data'); ?>"; ?></h3>
	</div>

<!--
	<div class="panel-body">
		Here you can add some description of this view.
	</div>
-->

	<div class="list-group">
<?php
foreach ($fields as $field) {
	$isKey = false;

	//Linked items
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\n\t\t<div class=\"list-group-item\">";

				echo "\n\t\t\t<h4 class=\"list-group-item-heading\"><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></h4>";

				echo "\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}']), array('class' => 'list-group-item-text')); ?>";

				echo "\n\t\t</div>\n";

				break;
			}
		}
	}

	//Unlinked items
	if ($isKey !== true) {
		echo "\n\t\t<div class=\"list-group-item\">";

		echo "\n\t\t\t<h4 class=\"list-group-item-heading\"><?php echo __('" . Inflector::humanize($field) . "'); ?></h4>";

		echo "\n\t\t\t<p class=\"list-group-item-text\">";

		echo "\n\t\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>";

		echo "\n\t\t\t</p>";

		echo "\n\t\t</div>\n";
	}
}
?>
	</div>


	<div class="panel-footer">
		<div class="btn-toolbar" role="toolbar">

			<div class="btn-group" role="group">
<?php
	echo "\t\t\t\t<?php echo \$this->Html->link(__('Edit " . $singularHumanName ."'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-warning')); ?>\n";

	echo "\t\t\t\t<?php echo \$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
?>
			</div>

			<div class="btn-group dropup" role="group">

				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<?php
	echo "\t\t\t\t\t<?php echo __('Other actions'); ?> <span class=\"caret\"></span>\n";
?>
				</button>

				<ul class="dropdown-menu" role="menu">
<?php
	echo "\t\t\t\t\t<li><?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index')); ?></li>\n";

	echo "\t\t\t\t\t<li><?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add')); ?></li>\n";

	if (count($associations)) {
		echo "\t\t\t\t\t<li class=\"divider\"></li>\n";
	}

	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\n\t\t\t\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
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

</div><!-- END -view -->




<div id="<?php echo $pluralVar; ?>-related" class="panel panel-default">

	<div class="panel-heading">
		<h3 class="panel-title"><?php echo "<?php echo __('Related data'); ?>"; ?></h2>
	</div>


	<div class="panel-body">
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
		<div id="<?php echo $pluralVar; ?>-related-hasOne" class="panel panel-active">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h4>
			</div>

			<!-- <div class="panel-body"></div>	 -->

<?php 	echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>

			<div class="list-group">
<?php
		foreach ($details['fields'] as $field) {
			echo "\t\t\t\t<div class=\"list-group-item\">\n";

			echo "\t\t\t\t<h5 class=\"list-group-item-heading\"><?php echo __('" . Inflector::humanize($field) . "'); ?></h5>\n";
			echo "\t\t\t\t\t<p class=\"list-group-item-text\">\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</p>\n";

			echo "\t\t\t\t</div>\n";
		}
?>
			</div>
<?php
		echo "<?php endif; ?>\n"; ?>

			<div class="panel-footer">
				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group" role="group">
<?php
		echo "\t\t\t\t\t\t<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}']), array('class' => 'btn btn-warning')); ?></li>\n"; ?>
					</div>
				</div>
			</div>

		</div>

<?php
	endforeach; //$associations['hasOne'] as $alias => $details
endif; //!empty($associations['hasOne'])
?>

<?php
if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?></h4>
			</div>

			<div class="panel-body" style="overflow: auto;">
<?php
		echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
				<table class="table table-bordered">
				<thead>
					<tr>
<?php
		foreach ($details['fields'] as $field) {
			echo "\t\t\t\t\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
		}
?>
						<th style="border-collapse: collapse; white-space: nowrap; width: 1px;"><?php echo "<?php echo __('Actions'); ?>";//Auto resize to fit this ?></th>
					</tr>
				</thead>

				<tbody>
<?php
		echo "\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
			echo "\t\t\t\t\t<tr>\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
			}

			echo "\t\t\t\t\t\t<td class=\"text-center\" style=\"min-width: 8em;\">\n";

			echo "\t\t\t\t\t\t\t<div class=\"btn-group\" role=\"group\">\n";

			echo "\t\t\t\t\t\t\t\t<?php echo \$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']), array('class' => 'btn btn-default btn-sm')); ?>\n";

			$_separateButton =
"								<a href=\"#\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
									<span class=\"fa fa-caret-down\"></span>
									<span class=\"sr-only\">Toggle Dropdown</span>
								</a>";

			echo "$_separateButton\n";

			echo "\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\" role=\"menu\">\n";

				echo "\t\t\t\t\t\t\t\t\t<li><?php echo \$this->Html->link('<i class=\"fa fa-edit fa-fw\"></i> ' . __('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape' => false)); ?></li>\n";

				echo "\t\t\t\t\t\t\t\t\t<li><?php echo \$this->Form->postLink('<i class=\"fa fa-trash-o fa-fw\"></i> ' . __('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), array('escape' => false), __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?></li>\n";

			echo "\t\t\t\t\t\t\t\t</ul>\n";

			echo "\t\t\t\t\t\t\t</div>\n";

			echo "\t\t\t\t\t\t</td>\n";

			echo "\t\t\t\t\t</tr>\n";

		echo "\t<?php endforeach; ?>\n";
	?>
				</tbody>
				</table>
<?php 	echo "<?php endif; ?>\n\n"; ?>

				<div class="btn-group" role="group">
<?php 	echo "\t\t\t\t<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('class' => 'btn btn-primary')); ?>\n"; ?>
				</div>


			</div>


		</div>
<?php
endforeach; //$relations as $alias => $details ?>

	</div> <!-- END -related panel-body -->

</div><!-- END -related -->
