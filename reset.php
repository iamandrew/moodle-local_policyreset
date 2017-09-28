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
 * Policy reset details.
 *
 * @package   local_policyreset
 * @copyright 2017 Andrew Davidson
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$PAGE->set_url('/local/policyreset/reset.php');
require_login();
$context = context_system::instance();
require_capability('local/policyreset:resetpolicyagreement', $context);
admin_externalpage_setup('local_policyreset_reset');

$PAGE->set_pagelayout('admin');

$confirm = optional_param('confirm', 0, PARAM_INT);
$performreset = optional_param('performreset', 0, PARAM_INT);

if ($performreset) {
    $DB->set_field('user', 'policyagreed', '0');
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('resetpolicy', 'local_policyreset'));
    echo $OUTPUT->box(get_string('resetsuccessful', 'local_policyreset'));
    echo $OUTPUT->footer();
} else if ($confirm) {
    require_sesskey();

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('resetpolicy', 'local_policyreset'));
    $yesurl = new moodle_url('/local/policyreset/reset.php', array('sesskey' => sesskey(), 'performreset' => '1'));
    $nourl = new moodle_url('/local/policyreset/reset.php');
    echo $OUTPUT->confirm(get_string('reallyresetpolicy', 'local_policyreset'), $yesurl, $nourl);
    echo $OUTPUT->footer();
} else {
    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('resetpolicy', 'local_policyreset'));
    echo $OUTPUT->box(get_string('resetpolicydesc', 'local_policyreset'));
    $confirmurl = new moodle_url('/local/policyreset/reset.php', array('sesskey' => sesskey(), 'confirm' => '1'));
    echo $OUTPUT->single_button($confirmurl, get_string('reset', 'local_policyreset'));
    echo $OUTPUT->footer();
}