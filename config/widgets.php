<?php
/**
 * Copyright 2016 Atelier Disko. All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace cms_survey\config;

use lithium\g11n\Message;
use base_core\extensions\cms\Widgets;
use cms_survey\models\Questionnaires;

extract(Message::aliases());

Widgets::register('survey',  function() use ($t) {
	return [
		'title' => $t('Surveys', ['scope' => 'cms_survey']),
		'data' => [
			$t('Filled Out', ['scope' => 'cms_survey']) => Questionnaires::find('count')
		]
	];
}, [
	'type' => Widgets::TYPE_COUNTER,
	'group' => Widgets::GROUP_DASHBOARD,
]);

?>