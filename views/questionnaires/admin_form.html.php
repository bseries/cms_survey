<?php

use lithium\g11n\Message;
use base_core\extensions\cms\Settings;

$t = function($message, array $options = []) {
	return Message::translate($message, $options + ['scope' => 'cms_survey', 'default' => $message]);
};

$this->set([
	'page' => [
		'type' => 'single',
		'title' => $item->title,
		'empty' => $t('untitled'),
		'object' => $t('questionnaire')
	],
	'meta' => [
		'has_note' => !empty($item->note) ? $t('has note') : null,
	]
]);

?>
<article>
	<?=$this->form->create($item) ?>
		<div class="grid-row">
			<div class="grid-column-left">
			</div>
			<div class="grid-column-right">
			</div>
		</div>

		<div class="grid-row">
			<h1 class="h-gamma"><?= $t('User') ?></h1>
			<div class="grid-column-left">
				<?= $this->form->field('user_id', [
					'type' => 'select',
					'label' => $t('User'),
					'list' => $users,
					'disabled' => $item->exists()
				]) ?>

			</div>
			<?php if ($user = $item->user()): ?>
			<div class="grid-column-right">
				<?= $this->form->field('user.number', [
					'label' => $t('Number'),
					'disabled' => true,
					'value' => $user->number
				]) ?>
				<?= $this->form->field('user.name', [
					'label' => $t('Name'),
					'disabled' => true,
					'value' => $user->name
				]) ?>
				<?= $this->form->field('user.email', [
					'label' => $t('Email'),
					'disabled' => true,
					'value' => $user->email
				]) ?>
				<?= $this->form->field('user.created', [
					'label' => $t('Signed up'),
					'disabled' => true,
					'value' => $this->date->format($user->created, 'datetime')
				]) ?>
			</div>
			<div class="actions">
				<?= $this->html->link($t('open user'), [
					'controller' => 'Users',
					'action' => 'edit',
					'id' => $user->id,
					'library' => 'base_core'
				], ['class' => 'button']) ?>
			</div>
			<?php endif ?>
		</div>

		<div class="grid-row">
			<section class="grid-column-left">
				<?= $this->form->field('note', [
					'type' => 'textarea',
					'label' => $t('Answers'),
					'disabled' => true,
					'value' => $item->format()
				]) ?>
				<div class="help"><?= $t('Visible to user.') ?></div>
			</section>
			<section class="grid-column-right">
				<?= $this->form->field('note', [
					'type' => 'textarea',
					'label' => $t('Note'),
					'disabled' => true
				]) ?>
				<div class="help"><?= $t('Visible to user.') ?></div>
			</section>
		</div>


		<div class="bottom-actions">
			<div class="bottom-actions__left">
				<?php if ($item->exists()): ?>
					<?= $this->html->link($t('delete'), [
						'action' => 'delete', 'id' => $item->id
					], ['class' => 'button large delete']) ?>
				<?php endif ?>
			</div>
			<div class="bottom-actions__right">
				<?= $this->form->button($t('save'), [
					'type' => 'submit',
					'class' => 'button large save'
				]) ?>
			</div>
		</div>

	<?=$this->form->end() ?>
</article>