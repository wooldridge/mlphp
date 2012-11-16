<?php
/*
Copyright 2002-2012 MarkLogic Corporation.  All Rights Reserved.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

require_once('Document.php');

/**
 * Represents an XML document.
 *
 * @package mlphp\document
 * @author Mike Wooldridge <mike.wooldridge@marklogic.com>
 */
class XMLDocument extends Document
{
    private $dom; // @var DOMDocument object

    /**
     * Create an XML document object.
     *
     * @param RESTClient $restClient A REST client object.
     * @param string $uri A document URI.
     */
    public function __construct($restClient, $uri = null)
    {
        parent::__construct($restClient, $uri);
        $this->dom = new DOMDocument();
        $this->contentType = 'application/xml';
    }

    /**
     * Get the document as a DOMDocument object.
     *
     * @return DOMDocument|null A DOMDocument object.
     */
    public function getAsDOMDocument()
    {
        return $this->dom->loadXML($this->getContent());
    }

}