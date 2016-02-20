<?php

namespace FaizShukri\Quran\Supports;

class Levenshtein
{
    public function closest($input, array $words)
    {
        // no shortest distance found, yet
        $shortest = -1;
        $match = [];

        // loop through words to find the closest
        foreach ($words as $word) {

            // calculate the distance between the input word,
            // and the current word
            $lev = levenshtein(strtolower($input), strtolower($word), 1, 2, 3);

            // check for an exact match
            if ($lev == 0) {

                // closest word is this one (exact match)
                $match = [$word];
                // $closest = $word;
                $shortest = 0;

                // break out of the loop; we've found an exact match
                break;
            }

            // if this distance is less than the next found shortest
            // distance, OR if a next shortest word has not yet been found

            if ($lev < $shortest || $shortest < 0) {
                // set the closest match, and shortest distance
                $match = [$word];
                // $closest = $word;
                $shortest = $lev;
            } elseif ($lev == $shortest) {
                $match[] = $word;
            }
        }

        if ($shortest > 6) {
            return [];
        }

        return $match;
    }
}
