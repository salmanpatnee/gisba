<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Online Threshold
    |--------------------------------------------------------------------------
    |
    | Number of minutes since last_activity_at after which an active session
    | is no longer considered "online". Deliberately independent of
    | session.lifetime, which governs auth expiry, not presence display.
    |
    */

    'online_threshold_minutes' => (int) env('USER_ACTIVITY_ONLINE_THRESHOLD', 5),

    /*
    |--------------------------------------------------------------------------
    | Activity Retention
    |--------------------------------------------------------------------------
    |
    | Number of days to keep session_activities rows before the
    | sessions:prune-activities command deletes them.
    |
    */

    'activity_retention_days' => (int) env('USER_ACTIVITY_RETENTION_DAYS', 90),

];
