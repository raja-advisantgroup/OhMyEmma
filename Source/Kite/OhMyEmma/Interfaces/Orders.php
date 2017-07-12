<?php

/**
 * This file is part of the Kite\OhMyEmma Library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Author Neal Lambert
 * @crankeye on GitHub
 * https://github.com/jwoodcock/CurlBack
 *
 * @license http://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 */

namespace Kite\OhMyEmma\Interfaces;

/**
 * Class for creating orders using the members/{member_id}/orders endpoint.
 * For full details of data formats and individual endpoints
 * refer to MyEmma.com's documentation. Last found here:
 * http://api.myemma.com/api/external/event_api.html
 */
class Orders
{

    /**
     * Request Object passed in via the 
     * factory controller. 
     *
     * @var object 
     */
    private $_request = '';

    /**
     * Emma url for events api.
     *
     * @var string
     */
    private $_baseURL = 'https://api.e2ma.net/';

    /**
     * Construct the member object which 
     * requires the request object from 
     * the factory
     *
     * @param object $request
     */
    public function __construct($request)
    {
        if (is_object($request)) {
            $this->_request = clone $request;
            $this->_request->_baseURL = $this->_baseURL;
        } else {
            return 'You can not use this class without a valid request object';
        }
    }

    /**
     * Method for creating a new orders
     * member must currently have and "Active" status.
     *
     * @param numeric $member_id
     * @param array $fields
     */
    public function createOrder($member_id, $fields = [])
    {
        $this->_request->method = 'POST';
        $url = "/members/".$member_id."/orders";

        $this->_request->postData = $fields;

        return $this->_request->processRequest($url);
    }
    
    /**
    * Method for updating single order
    * @param int $member_id		Emma Member Id
    * @param int $order		Emma Order Id
    * @return Returns order object if success false if not
    */
    function updateOrder($member_id, $order_id, $fields = []){
        $this->_request->method = 'POST';
        $url = "/members/".$member_id."/orders/". $order_id;
        $this->_request->postData = $fields;
        return $this->_request->processRequest($url);
    }
    
    /**
    * Method for retrieving single order
    * @param sring $source		Source name
    * @param int source_order_id		Source order Id
    * @return Returns order object if success false if not
    */
    function updateOrder($source, $source_order_id, $fields = []){
        $this->_request->method = 'POST';
        $url = "/products/lookup?source=".$source."&source_order_id=". $source_order_id;
        $this->_request->postData = $fields;
        return $this->_request->processRequest($url);
    }

}
