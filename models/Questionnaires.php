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
 * License. If not, see https://atelierdisko.de/licenses.
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
				'User.number',
				'User.name',
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