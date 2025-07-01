<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockSeeder extends Seeder
{
	public function run()
	{
		DB::table('blocks')->insert([
			[
				// Überschrift
				// ID: 1
				'block_group_id' => 1,
				'key' => 'headline',
				'name' => 'Überschrift',
				'order' => 1,
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46"><path fill="#4b87ff" d="M22.5,16h-12c-.552,0-1,.448-1,1v1.842c0,.552.448,1,1,1s1-.448,1-1v-.842h4v10h-1.07c-.552,0-1,.447-1,1s.448,1,1,1h4.044c.552,0,1-.447,1-1s-.448-1-1-1h-.974v-10h4v.842c0,.552.448,1,1,1s1-.448,1-1v-1.842c0-.552-.448-1-1-1Z" /><path fill="#535862" d="M35.5,30h-8c-.553,0-1-.447-1-1s.447-1,1-1h8c.553,0,1,.447,1,1s-.447,1-1,1ZM35.5,24h-8c-.553,0-1-.448-1-1s.447-1,1-1h8c.553,0,1,.448,1,1s-.447,1-1,1ZM35.5,18h-8c-.553,0-1-.448-1-1s.447-1,1-1h8c.553,0,1,.448,1,1s-.447,1-1,1ZM31.4,42H14.6c-3.516,0-5.281,0-6.778-.764-1.326-.675-2.383-1.733-3.059-3.059-.763-1.497-.763-3.262-.763-6.777V14.6c0-3.516,0-5.281.763-6.778.676-1.326,1.733-2.384,3.059-3.06,1.498-.763,3.263-.763,6.778-.763h16.8c3.516,0,5.28,0,6.777.763,1.325.676,2.384,1.733,3.059,3.059.764,1.498.764,3.262.764,6.778v16.8c0,3.516,0,5.28-.764,6.777-.675,1.325-1.733,2.384-3.059,3.059-1.497.764-3.262.764-6.777.764ZM14.6,6c-3.196,0-4.801,0-5.871.545-.947.482-1.702,1.238-2.185,2.185-.545,1.069-.545,2.674-.545,5.87v16.8c0,3.196,0,4.8.545,5.869.482.947,1.238,1.703,2.185,2.186,1.07.545,2.674.545,5.87.545h16.8c3.195,0,4.8,0,5.869-.545.947-.482,1.703-1.238,2.186-2.186.545-1.069.545-2.674.545-5.869V14.6c0-3.196,0-4.8-.545-5.87-.482-.947-1.238-1.703-2.186-2.185-1.069-.545-2.673-.545-5.869-.545H14.6Z" /></svg>',
				'settings' => json_encode([
					'fields' => [
						[
							'name' => 'text',
							'type' => 'text',
							'label' => null,
							'placeholder' => 'Überschrift eingeben...',
							'position' => 'fields',
						],
						[
							'name' => 'tag',
							'type' => 'button-group',
							'label' => null,
							'position' => 'options',
							'options' => ['h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6'],
							'defaultValue' => 'h2',
						],
						[
							'name' => 'appearance',
							'type' => 'button-group',
							'label' => 'Anzeigen als',
							'description' => 'Bestimmt das Aussehen der Überschrift, ohne den HTML-Tag zu verändern.',
							'position' => 'sidebar',
							'options' => ['h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6'],
						],
						[
							'name' => 'design',
							'type' => 'select',
							'label' => 'Design',
							'position' => 'sidebar',
							'options' => [
								'' => 'Standart',
								'large-centered-green' => 'Groß und zentriert (Grün)',
								'large-centered-blue' => 'Groß und zentriert (Blau)',
							],
							'defaultValue' => '',
						],
					],
				]),
				'active' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				// Text
				// ID: 2
				'block_group_id' => 1,
				'key' => 'text',
				'name' => 'Text',
				'order' => 2,
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46"><path fill="#535862" d="M40.25,34.833H5.75c-.552,0-1-.447-1-1s.448-1,1-1h34.5c.553,0,1,.447,1,1s-.447,1-1,1ZM40.25,27.167H5.75c-.552,0-1-.447-1-1s.448-1,1-1h34.5c.553,0,1,.447,1,1s-.447,1-1,1ZM40.25,19.5H5.75c-.552,0-1-.448-1-1s.448-1,1-1h34.5c.553,0,1,.448,1,1s-.447,1-1,1Z" /><path fill="#4b87ff" d="M19.75,12H5.75c-.552,0-1-.448-1-1s.448-1,1-1h14c.552,0,1,.448,1,1s-.448,1-1,1Z" /></svg>',
				'settings' => json_encode([
					'fields' => [
						[
							'name' => 'text',
							'type' => 'wysiwyg',
							'label' => null,
							'placeholder' => 'Text eingeben...',
							'position' => 'fields',
						],
						[
							'name' => 'limit_width',
							'type' => 'checkbox',
							'label' => 'Weite',
							'position' => 'sidebar',
							'defaultValue' => 1,
							'text' => 'Weite limitieren',
						],
					],
				]),
				'active' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
        ]};
	}
}
