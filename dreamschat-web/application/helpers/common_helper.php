<?php
if(!function_exists('human_time_diff')){
define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS );
define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS );
define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS );
define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS );

  function human_time_diff( $from, $to = 0 ) {
    if ( empty( $to ) ) {
        $to = time();
    }
 
    $diff = (int) abs( $to - $from );
 
    if ( $diff < MINUTE_IN_SECONDS ) {
        $secs = $diff;
        if ( $secs <= 1 ) {
            $secs = 1;
        }
        /* translators: Time difference between two dates, in seconds. %s: Number of seconds. */
        $since = sprintf('%s seconds', $secs );
    } elseif ( $diff < HOUR_IN_SECONDS && $diff >= MINUTE_IN_SECONDS ) {
        $mins = round( $diff / MINUTE_IN_SECONDS );
        if ( $mins <= 1 ) {
            $mins = 1;
        }
        /* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes. */
        $since = sprintf('%s mins', $mins );
    } elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
        $hours = round( $diff / HOUR_IN_SECONDS );
        if ( $hours <= 1 ) {
            $hours = 1;
        }
        /* translators: Time difference between two dates, in hours. %s: Number of hours. */
        $since = sprintf('%s hours', $hours );
    } elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
        $days = round( $diff / DAY_IN_SECONDS );
        if ( $days <= 1 ) {
            $days = 1;
        }
        /* translators: Time difference between two dates, in days. %s: Number of days. */
        $since = sprintf('%s days', $days );
    } elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
        $weeks = round( $diff / WEEK_IN_SECONDS );
        if ( $weeks <= 1 ) {
            $weeks = 1;
        }
        /* translators: Time difference between two dates, in weeks. %s: Number of weeks. */
        $since = sprintf('%s weeks', $weeks );
    } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
        $months = round( $diff / MONTH_IN_SECONDS );
        if ( $months <= 1 ) {
            $months = 1;
        }else{
			$months = 'few';
		}
        /* translators: Time difference between two dates, in months. %s: Number of months. */
        $since = sprintf('%s months', $months );
    } elseif ( $diff >= YEAR_IN_SECONDS ) {
        $years = round( $diff / YEAR_IN_SECONDS );
        if ( $years <= 1 ) {
            $years = 1;
        }else{
			$years = 'few';
		}
        /* translators: Time difference between two dates, in years. %s: Number of years. */
        $since = sprintf('%s years', $years );
    }
 
    /**
     * Filters the human readable difference between two timestamps.
     *
     * @since 4.0.0
     *
     * @param string $since The difference in human readable text.
     * @param int    $diff  The difference in seconds.
     * @param int    $from  Unix timestamp from which the difference begins.
     * @param int    $to    Unix timestamp to end the time difference.
     */
    return $since.' ago';
	}

}
?>