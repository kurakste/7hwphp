<?php 
/**
 *
 * @author kurakste
 * @version $Id$
 * @copyright kurakste, 08 июня, 2018
 * @package default
 */

/**
 * Returns curent catalog as HTML string
 */
function getCatalogAsHTML()
{
    $out = renderComponent ('catalog');

    return directView(['content'=>$out]);
}

