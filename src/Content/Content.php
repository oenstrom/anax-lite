<?php

namespace Oenstrom\Content;

/**
 * Content class for general content.
 */
class Content
{
    /**
     * @var integer         $id the content id
     * @var string          $path the content path
     * @var string          $slug the content slug
     * @var string          $title the content title
     * @var string          $data the content text
     * @var string          $type the content type
     * @var string          $filter the content text filter
     * @var datetime        $published time of publish
     * @var datetime        $created time created
     * @var datetime        $updated time of the latest update
     * @var datetime        $deleted time deleted
     */
    protected $id;
    protected $path;
    protected $slug;
    protected $title;
    protected $data;
    protected $type;
    protected $filter;
    protected $published;
    protected $created;
    protected $updated;
    protected $deleted;


    /**
     * Get the value of a specified property.
     *
     * @param string $var The name of the property.
     * @return mixed as the value of the property.
     */
    public function get($var)
    {
        return $this->{$var};
    }


    /**
     * Update the object.
     *
     * @param array $fields The new values.
     */
    public function update($fields)
    {
        $this->title = $fields["title"];
        $this->data = $fields["data"];
        $this->type = $fields["type"];
        $this->filter = $fields["filter"];
        $this->published = $this->validateDatetime($fields["published"]) ? $fields["published"] : null;
        $this->path = empty(slugify($fields["path"])) ? null : slugify($fields["path"]);
        $this->slug = slugify($fields["slug"]) ?: slugify($fields["title"]);
    }


    /**
     * Validate that a string is in the right datetime format.
     *
     * @param string $datetime The datetime string.
     * @return bool If valid or not.
     */
    public function validateDatetime($datetime)
    {
        $dateTimeObj = new \DateTime();
        $dateTimeObj = $dateTimeObj::createFromFormat('Y-m-d H:i:s', $datetime);
        return $dateTimeObj && $dateTimeObj->format('Y-m-d H:i:s') === $datetime;
    }
}
