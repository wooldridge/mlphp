<?php

/**
 * Represents a word constraint for search.
 *
 * @package mlphp\options
 * @author Mike Wooldridge <mike.wooldridge@marklogic.com>
 */
class WordConstraint extends AbstractConstraint
{
    private $elem; // @var string
    private $ns; // @var string
    private $attr; // @var string
    private $attrNs; // @var string
    protected $fragmentScope; // @var string
    protected $termOptions; // @var array

    /**
     * Create a WordConstraint object.
     *
     * @see http://docs.marklogic.com/search:search#opt-constraint
     *
     * @param string $name Constraint name.
     * @param string $elem Element name.
     * @param string $ns An element namespace.
     * @param string $attr Attribute name.
     * @param string $attrNs An attribute namespace.
     */
    public function __construct($name, $elem, $ns = '', $attr = '', $attrNs = '')
    {
        $this->elem = (string)$elem;
        $this->ns = (string)$ns;
        $this->attr = (string)$attr;
        $this->attrNs = (string)$attrNs;
        parent::__construct($name);
    }

    /**
     * Get the constraint as a DOMElement object.
     *
     * @param DOMDocument $dom The DOMDocument object with which to create the element.
     */
    public function getAsElem($dom)
    {
        $constElem = $dom->createElement('constraint');
        $constElem->setAttribute('name', $this->name);
        $wordElem = $dom->createElement('word');
        $elemElem = $dom->createElement('element');
        $elemElem->setAttribute('ns', $this->ns);
        $elemElem->setAttribute('name', $this->elem);
        $wordElem->appendChild($elemElem);
        if($this->attr) {
            $attrElem = $dom->createElement('attribute');
            $attrElem->setAttribute('ns', $this->attrNs);
            $attrElem->setAttribute('name', $this->attr);
            $wordElem->appendChild($attrElem);
        }
        $this->addTermOptions($dom, $wordElem);
        $this->addFragmentScope($dom, $wordElem);
        $constElem->appendChild($wordElem);
        /* <constraint name='intitle'>
                <word>
                   <element ns='http://example.com' name='title'/>
                </word>
             </constraint> */
        return $constElem;
    }
}