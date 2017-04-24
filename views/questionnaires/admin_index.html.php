<?php

use lithium\g11n\Message;
use base_core\extensions\cms\Settings;

$t = function($message, array $options = []) {
	return Message::translate($message, $options + ['scope' => 'cms_survey', 'default' => $message]);
};

$this->set([
	'page' => [
		'type' => 'multiple',
		'object' => $t('questionnaires')
	]
]);

?>
<article
	class="use-rich-index"
	data-endpoint="<?= $this->url([
		'action' => 'index',
		'page' => '__PAGE__',
		'orderField' => '__ORDER_FIELD__',
		'orderDirection' => '__ORDER_DIRECTION__',
		'filter' => '__FILTER__'
	]) ?>"
>

	<div class="top-actions">
		<?= $this->html->link($t('questionnaire'), ['action' => 'add'], ['class' => 'button add']) ?>
	</div>

	<?php if ($data->count()): ?>
		<table>
			<thead>
				<tr>
					<td data-sort="User.name" class="user table-sort"><?= $t('User') ?>
					<td><?= $t('#answers') ?>
					<td class="flag has-note"><?= $t('note?') ?>
					<td data-sort="modified" class="date modified table-sort desc"><?= $t('Modified') ?>
					<td class="actions">
						<?= $this->form->field('search', [
							'type' => 'search',
							'label' => false,
							'placeholder' => $t('Filter'),
							'class' => 'table-search',
							'value' => $this->_request->filter
						]) ?>
			</thead>
			<tbody>
				<?php foreach ($data as $item): ?>
					<?php $user = $item->user() ?>
				<tr>
					<td class="user">
						<?= $this->user->link($user) ?>
					<td><?= count($item->positions) ?>
					<td class="flag"><i class="material-icons"><?= (!empty($item->note) ? 'done' : '') ?></i>
					<td class="date modified">
						<time datetime="<?= $this->date->format($item->modified, 'w3c') ?>">
							<?= $this->date->format($item->modified, 'date') ?>
						</time>
					<td class="actions">
						<?= $this->html->link($t('open'), ['id' => $item->id, 'action' => 'edit', 'library' => 'cms_survey'], ['class' => 'button']) ?>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="none-available"><?= $t('No items available, yet.') ?></div>
	<?php endif ?>

	<?=$this->_render('element', 'paging', compact('paginator'), ['library' => 'base_core']) ?>
</article>