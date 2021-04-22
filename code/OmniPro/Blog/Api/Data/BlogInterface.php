<?php
namespace OmniPro\Blog\Api\Data;

interface BlogInterface extends \Magento\Framework\Api\ExtensibleDataInterface 
{   
     /**
     * Return ID
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * Return Title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set Title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title);

    /**
     * Set Email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email);

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set Content
     *
     * @param string $content
     * @return void
     */
    public function setContent($content);

    /**
     * Get Content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set Image
     *
     * @param string $img
     * @return void
     */
    public function setImage($img);

    /**
     * Get Image
     *
     * @return string
     */
    public function getImage();

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \OmniPro\Blog\Api\Data\BlogExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \OmniPro\Blog\Api\Data\BlogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\OmniPro\Blog\Api\Data\BlogExtensionInterface $extensionAttributes);
}

    
    

