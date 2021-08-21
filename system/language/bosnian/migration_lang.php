<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	cikov
 * @copyright	Copyright (c) 2021, cikov, opensourcepos.org
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://opensourcepos.org
 * @since	Version 3.1.11
 * @filesource
 */
defined('BASEPATH') OR exit('Nije dozvoljen direktan pristup');

$lang['migration_none_found'] = 'Nisu pronađene migracije.';
$lang['migration_not_found'] = 'Nisu pronađene migracije sa verzijom: %s.';
$lang['migration_sequence_gap'] = 'Postoji praznina u sekvenci migracije u blizini broja verzije: %s.';
$lang['migration_multiple_version'] = 'Postoji više migracija sa istim brojem verzije: %s.';
$lang['migration_class_doesnt_exist'] = 'Klasa migracije "%s" ne može biti pronađena.';
$lang['migration_missing_up_method'] = 'Klasi migracije "%s" nedostaje "up" metoda.';
$lang['migration_missing_down_method'] = 'Klasi migracije "%s" nedostaje "down" metoda.';
$lang['migration_invalid_filename'] = 'Migracija "%s" ima nevažeće ime datoteke.';
