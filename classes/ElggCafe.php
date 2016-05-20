<?php
class ElggCafe extends ElggObject {
    const SUBTYPE = 'cafe';

    /**
     * Intialize the ElggQuestion class
     *
     * @return void
     */
    protected function initializeAttributes() {
        parent::initializeAttributes();
        $this->attributes['subtype'] = self::SUBTYPE;
    }

    public function lastComment() {
        $result = elgg_get_entities(array(
            'type' => 'object',
            'subtype' => 'comment',
            'container_guid' => $this->guid,
            'limit' => '1'
        ));

        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function countComments() {
        return elgg_get_entities(array(
            'type' => 'object',
            'subtype' => 'comment',
            'container_guid' => $this->guid,
            'count' => true
        ));
    }
}