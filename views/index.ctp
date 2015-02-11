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
<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>

<div id="<?php echo $pluralVar; ?>-index" class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo "<?php echo __('{$pluralHumanName}' . ' list'); ?>"; ?></h3>
	</div>

	<div class="panel-body" style="overflow: auto;">

		<table class="table table-bordered">
			<thead>
				<tr>
<?php
	foreach ($fields as $field): ?>
					<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php
	endforeach; ?>
					<th style="border-collapse: collapse; white-space: nowrap; width: 1px;"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
				</tr>
			</thead>

			<tbody>
<?php
	echo "\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";

	echo "\t\t\t\t<tr>\n";

	foreach ($fields as $field) {
		$isKey = false;
		if (!empty($associations['belongsTo'])) {
			foreach ($associations['belongsTo'] as $alias => $details) {
				if ($field === $details['foreignKey']) {
					$isKey = true;
					echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t\t\t</td>\n";
					break;
				}
			}
		}
		if ($isKey !== true) {
			echo "\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?></td>\n"; //Maybe should be shorted to a fix number of chars?
		}
	}
?>
					<td class="text-center" style="min-width: 8em;">
						<div class="btn-group" role="group">

							<?php echo "<?php echo \$this->Html->link(__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-default btn-sm')); ?>";?>

							<a href="#" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="fa fa-caret-down"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li><?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-edit fa-fw\"></i> ' . __('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false)); ?>";?></li>

								<li><?php echo "<?php echo \$this->Form->postLink('<i class=\"fa fa-trash-o fa-fw\"></i> ' . __('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>";?></li>
							</ul>

						</div>
					</td>
				</tr>
<?php
	echo "\t<?php endforeach; ?>\n";
?>
			</tbody>
		</table>

		<p>
<?php echo "<?php
			echo \$this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
?>"; ?>
		</p>

		<nav>
			<ul class="pagination">
<?php
	echo "<?php
			echo \$this->Paginator->prev(
				'<i class=\"fa fa-chevron-left fa-fw\"></i>',
				array(
					'tag' => 'li',
					'escape' => false,
					'disabledTag' => 'span',
				),
				null,
				array(
					'tag' => 'li',
					'escape' => false,
					'class' => 'disabled',
					'disabledTag' => 'span',
				)
			);

			echo \$this->Paginator->first(
				'<i class=\"fa  fa-angle-double-left fa-fw\"></i>',
				array(
					'tag' => 'li',
					'escape' => false,
				)
			);

			echo \$this->Paginator->numbers(array(
				'separator' => '',
				'tag' => 'li',
				'currentTag' => 'span',
				'currentClass' => 'active'
			));

			echo \$this->Paginator->last(
				'<i class=\"fa  fa-angle-double-right fa-fw\"></i>',
				array(
					'tag' => 'li',
					'escape' => false,
				)
			);

			echo \$this->Paginator->next(
				'<i class=\"fa fa-chevron-right fa-fw\"></i>',
				array(
					'tag' => 'li',
					'escape' => false,
					'disabledTag' => 'span',
				),
				null,
				array(
					'tag' => 'li',
					'escape' => false,
					'class' => 'disabled',
					'disabledTag' => 'span',
				)
			);\n";

		echo "?>\n";
?>
			</ul>
		</nav>
	</div>

	<div class="panel-footer">
		<div class="btn-toolbar" role="toolbar">
			<div class="btn-group" role="group">
				<?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'), array('class' => 'btn btn-primary')); ?>"; ?>
			</div>

			<div class="btn-group dropup" role="group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<?php
						echo "<?php echo __('Other actions'); ?> <span class=\"caret\"></span>\n";
					?>
				</button>

				<ul class="dropdown-menu" role="menu">
	<?php
				$done = array();
				foreach ($associations as $type => $data) {
					foreach ($data as $alias => $details) {
						if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
							echo "\t\t\t\t<li><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
							echo "\t\t\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
							$done[] = $details['controller'];
						}
					}
				}
	?>
				</ul>

		</div>
	</div>
</div>
