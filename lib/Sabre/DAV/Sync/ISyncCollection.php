<?php

/**
 * If a class extends ISyncCollection, it supports WebDAV-sync.
 *
 * @package Sabre
 * @subpackage DAV
 * @copyright Copyright (C) 2007-2012 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
interface Sabre_DAV_ISyncCollection extends Sabre_DAV_Collection {

    /**
     * Returns the current sync token for this node.
     *
     * Can be any string identifier, and is not required. The only requirement 
     * for the syncToken, is that it must change if a member of this collection 
     * changed.
     *
     * SabreDAV will prepend this token with a url.
     *
     * @return string
     */
    function getSyncToken();

    /**
     * The getChanges method returns all the changes that have happened, since 
     * the specified syncToken and the current collection.
     *
     * This function should return an array, such as the following:
     *
     * array(
     *   'syncToken' => 'The current synctoken',
     *   'modified'   => array(
     *      'new.txt',
     *   ),
     *   'deleted' => array(
     *      'foo.php.bak',
     *      'old.txt'
     *   )
     * );
     * 
     * The syncToken property should reflect the *current* syncToken of the 
     * collection, as reported getSyncToken(). This is needed here too, to 
     * ensure the operation is atomic.
     *
     * The modified property is an array of nodenames that have changed since 
     * the last token. 
     *
     * The deleted property is an array with nodenames, that have been deleted 
     * from collection.
     *
     * The second argument is basically the 'depth' of the report. If it's 1, 
     * you only have to report changes that happened only directly in immediate 
     * descendants. If it's 2, it should also include changes in the direct 
     * child collection. 
     *
     * The third (optional) argument allows a client to specify how many 
     * results should be returned at most. If the limit is not specified, it 
     * should be treated as infinite.
     *
     * If the limit (infinite or not) is higher than you're willing to return, 
     * you should throw a Sabre_DAV_Exception_TooMuchMatches() exception.
     *
     * You can ignore the limit if you want. 
     *
     * @param string $syncToken 
     * @param int $syncLevel
     * @param int $limit 
     * @return array 
     */
    function getChanges($syncToken, $syncLevel, $limit = null);

}

?>
