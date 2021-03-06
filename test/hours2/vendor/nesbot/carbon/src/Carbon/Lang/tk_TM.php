<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - Ghorban M. Tavakoly Pablo Saratxaga & Ghorban M. Tavakoly pablo@walon.org & gmt314@yahoo.com
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['Ýanwar', 'Fewral', 'Mart', 'Aprel', 'Maý', 'Iýun', 'Iýul', 'Awgust', 'Sentýabr', 'Oktýabr', 'Noýabr', 'Dekabr'],
    'months_short' => ['Ýan', 'Few', 'Mar', 'Apr', 'Maý', 'Iýn', 'Iýl', 'Awg', 'Sen', 'Okt', 'Noý', 'Dek'],
    'weekdays' => ['Duşenbe', 'Sişenbe', 'Çarşenbe', 'Penşenbe', 'Anna', 'Şenbe', 'Ýekşenbe'],
    'weekdays_short' => ['Duş', 'Siş', 'Çar', 'Pen', 'Ann', 'Şen', 'Ýek'],
    'weekdays_min' => ['Duş', 'Siş', 'Çar', 'Pen', 'Ann', 'Şen', 'Ýek'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
]);
