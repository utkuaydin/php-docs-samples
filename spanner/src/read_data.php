<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/spanner/README.md
 */

namespace Google\Cloud\Samples\Spanner;

// [START read_data]
use Google\Cloud\Spanner\SpannerClient;

/**
 * Reads sample data from the database.
 * Example:
 * ```
 * read_data($instanceId, $databaseId);
 * ```
 *
 * @param string $instanceId The Spanner instance ID.
 * @param string $databaseId The Spanner database ID.
 */
function read_data($instanceId, $databaseId)
{
    $spanner = new SpannerClient();
    $instance = $spanner->instance($instanceId);
    $database = $instance->database($databaseId);

    $keySet = $spanner->keySet(['all' => true]);
    $results = $database->read(
        'Albums',
        $keySet,
        ['SingerId', 'AlbumId', 'AlbumTitle']
    );

    foreach ($results->rows() as $row) {
        printf('SingerId: %s, AlbumId: %s, AlbumTitle: %s' . PHP_EOL,
            $row['SingerId'], $row['AlbumId'], $row['AlbumTitle']);
    }
}
// [END read_data]
