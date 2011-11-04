<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2011, Ivan Enderlin. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace Hoa\Http {

/**
 * Class \Hoa\Http.
 *
 *
 *
 * @author     Ivan Enderlin <ivan.enderlin@hoa-project.net>
 * @copyright  Copyright © 2007-2011 Ivan Enderlin.
 * @license    New BSD License
 */

class Http implements \ArrayAccess {

    /**
     * Whether PHP is running with FastCGI or not.
     *
     * @var \Hoa\Http\Response bool
     */
    private static $_fcgi = null;

    /**
     * Headers (not sent).
     *
     * @var \Hoa\Http\Response array
     */
    protected $_headers   = array();



    /**
     * Constructor.
     *
     * @access  public
     * @return  void
     */
    public function __construct ( ) {

        if(null === self::$_fcgi)
            self::$_fcgi = 'cgi-fcgi' == PHP_SAPI;

        return;
    }

    /**
     * Get headers.
     *
     * @access  public
     * @return  void
     */
    public function getHeaders ( ) {

        return implode("\r\n", $this->_headers);
    }

    /**
     * Parse HTTP headers.
     *
     * @access  public
     * @return  array
     */
    public function parse ( $packet ) {

        unset($this->_headers);
        $this->_headers = array();

        // ...

        return $this->_headers;
    }

    /**
     * Check if header exists.
     *
     * @access  public
     * @param   string  $offset    Header.
     * @return  bool
     */
    public function offsetExists ( $offset ) {

        return array_key_exists($offset, $this->_headers);
    }

    /**
     * Get a header's value.
     *
     * @access  public
     * @param   string  $offset    Header.
     * @return  string
     */
    public function offsetGet ( $offset ) {

        if(false === $this->offsetExists($offset))
            return null;

        return $this->_headers[$offset];
    }

    /**
     * Set a value to a header.
     *
     * @access  public
     * @param   string  $offset    Header.
     * @param   string  $value     Value.
     * @return  void
     */
    public function offsetSet ( $offset, $value ) {

        $this->_headers[$offset] = $value;

        return;
    }

    /**
     * Unset a header.
     *
     * @access  public
     * @param   string  $offset    Header.
     * @return  void
     */
    public function offsetUnset ( $offset ) {

        unset($this->_headers[$offset]);

        return;
    }
}

}
