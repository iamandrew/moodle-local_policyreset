<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * You may have settings in your plugin
 *
 * @package    local_policyreset
 * @copyright  2017 Andrew Davidson
 * @license    http://www.gnu.org/copyleft/gpl.html gnu gpl v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
	$settings = new admin_settingpage('local_policyreset', get_string('pluginname', 'local_policyreset'));
    $reseturl = new moodle_url('/local/policyreset/reset.php');
    $ADMIN->add('localplugins', new admin_externalpage(
        'local_policyreset_reset',
        new lang_string('resetpolicy', 'local_policyreset'),
        $reseturl
    ));
    $ADMIN->add('localplugins', $settings);
}
