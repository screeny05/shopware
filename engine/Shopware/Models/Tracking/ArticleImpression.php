<?php
/**
 * Shopware 4.0
 * Copyright © 2013 shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    Shopware_Models
 * @subpackage Tracking
 * @copyright  Copyright (c) 2013, shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author     $Author$
 */

namespace Shopware\Models\Tracking;

use Shopware\Components\Model\ModelEntity,
    Doctrine\ORM\Mapping AS ORM;

/**
 * Article Impression Statistics
 * <br>
 * This Model represents the database table s_statistics_article_impression. This is used to track
 * every article impression. The clicks and impressions will be accumulated on a daily basis.
 *
 * Indices for s_statistics_article_impression:
 * <code>
 *   - PRIMARY KEY (`id`)
 *   - INDEX (articleId)
 * </code>
 *
 * @ORM\Table(name="s_statistics_article_impression")
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\HasLifecycleCallbacks
 */
class ArticleImpression extends ModelEntity
{
    /**
     * Autoincrement Identifier
     *
     * @var integer $id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Date $date
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * ID of the article which should be tracked
     *
     * @var integer $articleId
     *
     * @ORM\Column(name="articleId", type="integer", nullable=false)
     */
    private $articleId;

    /**
     * Accumulated number of impressions
     *
     * @var integer $impressions
     *
     * @ORM\Column(name="impressions", type="integer", nullable=false)
     */
    private $impressions;

    /**
     * Constructor
     *
     * @param $articleId
     * @param $date
     * @param int $impressions
     */
    public function __construct($articleId, $date = null, $impressions = 1)
    {
        if ($date === null) {
            $date = new \DateTime();
        }
        $this->setArticleId($articleId);
        $this->setDate($date);
        $this->setImpressions($impressions);
    }

    /**
     * Get the Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set the date
     *
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * get the date
     *
     * @return \Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * set the articleId
     *
     * @param int $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * get the articleId
     *
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * set the impressions
     *
     * @param int $impressions
     */
    public function setImpressions($impressions)
    {
        $this->impressions = $impressions;
    }

    /**
     * get the impressions
     *
     * @return int
     */
    public function getImpressions()
    {
        return $this->impressions;
    }

    /**
     * Increases the number of impressions
     *
     * @return \Shopware\Models\Tracking\ArticleImpression
     */
    public function increaseImpressions()
    {
        $this->impressions++;
        return $this;
    }
}
