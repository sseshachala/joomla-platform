<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Installer
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.filesystem.file');

/**
 * Joomla! Library Manifest File
 *
 * @package     Joomla.Platform
 * @subpackage  Installer
 * @since       11.1
 */
class JLibraryManifest extends JObject
{
	/**
	 * @var string name Name of Library
	 */
	protected $name = '';

	/**
	 * @var string libraryname File system name of the library
	 */
	protected $libraryname = '';

	/**
	 * @var string version Version of the library
	 */
	protected $version = '';

	/**
	 * @var string description Description of the library
	 */
	protected $description = '';

	/**
	 * @var date creationDate Creation Date of the extension
	 */
	protected $creationDate = '';

	/**
	 * @var string copyright Copyright notice for the extension
	 */
	protected $copyright = '';

	/**
	 * @var string license License for the extension
	 */
	protected $license = '';

	/**
	 * @var string author Author for the extension
	 */
	protected $author = '';

	/**
	 * @var string authoremail Author email for the extension
	 */
	protected $authoremail = '';

	/**
	 * @var string authorurl Author url for the extension
	 */
	protected $authorurl = '';

	/**
	 * @var string packager Name of the packager for the library (may also be porter)
	 */
	protected $packager = '';

	/**
	 * @var string packagerurl URL of the packager for the library (may also be porter)
	 */
	protected $packagerurl = '';

	/**
	 * @var string update URL of the update site
	 */
	protected $update = '';

	/**
	 * @var string[] filelist List of files in the library
	 */
	protected $filelist = array();

	/**
	 * @var string manifest_file Path to manifest file
	 */
	protected $manifest_file = '';

	/**
	 * Constructor
	 *
	 * @param   string  $xmlpath  Path to an XML file to load the manifest from.
	 *
	 * @since   11.1
	 */
	public function __construct($xmlpath = '')
	{
		if (strlen($xmlpath))
		{
			$this->loadManifestFromXML($xmlpath);
		}
	}

	/**
	 * Load a manifest from a file
	 *
	 * @param   string  $xmlfile  Path to file to load
	 *
	 * @return  boolean
	 *
	 * @since   11.1
	 */
	public function loadManifestFromXML($xmlfile)
	{
		$this->manifest_file = JFile::stripExt(basename($xmlfile));

		$xml = JFactory::getXML($xmlfile);
		if (!$xml)
		{
			$this->_errors[] = JText::sprintf('JLIB_INSTALLER_ERROR_LOAD_XML', $xmlfile);
			return false;
		}
		else
		{
			$this->name = (string) $xml->name;
			$this->libraryname = (string) $xml->libraryname;
			$this->version = (string) $xml->version;
			$this->description = (string) $xml->description;
			$this->creationdate = (string) $xml->creationdate;
			$this->author = (string) $xml->author;
			$this->authoremail = (string) $xml->authorEmail;
			$this->authorurl = (string) $xml->authorUrl;
			$this->packager = (string) $xml->packager;
			$this->packagerurl = (string) $xml->packagerurl;
			$this->update = (string) $xml->update;

			if (isset($xml->files) && isset($xml->files->file) && count($xml->files->file))
			{
				foreach ($xml->files->file as $file)
				{
					$this->filelist[] = (string) $file;
				}
			}
			return true;
		}
	}
}
