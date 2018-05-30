<?php
/**
 * Copyright 2016 Atelier Disko. All rights reserved.
 *
 * Use of this source code is governed by a BSD-style
 * license that can be found in the LICENSE file.
 */

namespace cms_survey\models;

class Questionnaires extends \base_core\models\Base {

	protected $_actsAs = [
		'base_core\extensions\data\behavior\RelationsPlus',
		'base_core\extensions\data\behavior\Timestamp',
		'base_core\extensions\data\behavior\Serializable' => [
			'fields' => [
				'positions' => 'json'
			]
		],
		'base_core\extensions\data\behavior\Searchable' => [
			'fields' => [
				'User.name',
				'User.number'
			]
		]
	];

	public $belongsTo = [
		'User' => [
			'to' => 'base_core\models\Users',
			'key' => 'user_id'
		]
	];

	protected static $_sections = [];

	public static function registerSection($name, array $data) {
		static::$_sections[$name] = $data;
	}

	public static function sections() {
		return static::$_sections;
	}

	public function format($entity) {
		$results = [];

		foreach ($entity->positions as $key => $value) {
			if (empty($value)) {
				continue;
			}
			$results[] = "{$key}: " . (is_array($value) ? implode(', ', $value) : $value);
		}
		return implode("\n", $results);
	}

	public function isCompleted($entity) {
		$totalQuestions = 0;
		foreach (static::$_sections as $section => $questions) {
			$totalQuestions += count($questions);
		}
		return count($entity->positions) >= $totalQuestions;
	}
}

?>