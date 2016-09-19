<?php
/**
 * CMS Survey
 *
 * Copyright (c) 2016 Atelier Disko - All rights reserved.
 *
 * Licensed under the AD General Software License v1.
 *
 * This software is proprietary and confidential. Redistribution
 * not permitted. Unless required by applicable law or agreed to
 * in writing, software distributed on an "AS IS" BASIS, WITHOUT-
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * You should have received a copy of the AD General Software
 * License. If not, see http://atelierdisko.de/licenses.
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