<?php
/**
 * Copyright 2016 Atelier Disko. All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace cms_survey\config;

use base_core\extensions\cms\Panes;
use lithium\g11n\Message;

extract(Message::aliases());

Panes::register('user.questionnaires', [
	'title' => $t('Questionnaires', ['scope' => 'cms_survey']),
	'url' => ['controller' => 'questionnaires', 'action' => 'index', 'library' => 'cms_survey', 'admin' => true],
	'weight' => 60
]);

?>