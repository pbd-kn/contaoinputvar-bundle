<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 * @copyright  Peter Broghammer 2020
 * @author     Peter Broghammer (PBD)
 * @package    Contao Inputvar Bundle
 * @license    LGPL-3.0-or-later
 */

namespace PBDKN\ContaoInputVarBundle;

class InputVar extends \contao\Frontend
{
    public function replaceInputVars($strTag)
    {
        $arrTag = explode('::', $strTag);

        if ('' === $arrTag[1]) {
            return false;
        }

        switch ($arrTag[0]) {
            case 'get':
                $this->import('Contao\Input');
                $varValue = $this->Input->get($arrTag[1]);
                                $varValue .= '<br>hallo<br>';
                break;

            case 'post':
                $this->import('Contao\Input');
                $varValue = $this->Input->post($arrTag[1]);
                break;

            case 'postHtml':
                $this->import('Contao\Input');
                $varValue = $this->Input->postHtml($arrTag[1]);
                break;

            case 'postRaw':
                $this->import('Contao\Input');
                $varValue = $this->Input->postRaw($arrTag[1]);
                break;

            case 'cookie':
                $this->import('Contao\Input');
                $varValue = $this->Input->cookie($arrTag[1]);
                break;

            case 'session':
                $this->import('Session');
                $varValue = $this->Session->get($arrTag[1]);
                break;

            default:
                return false;
        }

        switch ($arrTag[2]) {
            case 'mysql_real_escape_string':
            case 'addslashes':
            case 'stripslashes':
            case 'standardize':
            case 'ampersand':
            case 'specialchars':
            case 'nl2br':
            case 'nl2br_pre':
            case 'strtolower':
            case 'utf8_strtolower':
            case 'strtoupper':
            case 'utf8_strtoupper':
            case 'ucfirst':
            case 'lcfirst':
            case 'ucwords':
            case 'trim':
            case 'rtrim':
            case 'ltrim':
            case 'utf8_romanize':
            case 'strlen':
            case 'strrev':
                $varValue = $arrTag[2]($varValue);
                break;

            case 'decodeEntities':
            case 'encodeEmail':
                $this->import('String');
                $varValue = $this->String->{$arrTag[2]}($varValue);
                break;

            case 'number_format':
                $varValue = number_format($varValue, 0, $GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
                break;

            case 'number_format_2':
                $varValue = number_format($varValue, 2, $GLOBALS['TL_LANG']['MSC']['decimalSeparator'], $GLOBALS['TL_LANG']['MSC']['thousandsSeparator']);
                break;
        }

        return \is_array($varValue) ? implode(', ', $varValue) : $varValue;
    }
}
