<?php

namespace Ticme\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="um_cities", uniqueConstraints={@ORM\UniqueConstraint(name="city_code_town_2", columns={"city_code_town"}), @ORM\UniqueConstraint(name="city_slug", columns={"city_slug"})}, indexes={@ORM\Index(name="city_departement", columns={"city_departement"}), @ORM\Index(name="city_name", columns={"city_name"}), @ORM\Index(name="city_name_real", columns={"city_name_real"}), @ORM\Index(name="city_code_town", columns={"city_code_town"}), @ORM\Index(name="city_zipcode", columns={"city_zipcode"}), @ORM\Index(name="city_longitude_latitude_deg", columns={"city_longitude_deg", "city_latitude_deg"}), @ORM\Index(name="city_name_soundex", columns={"city_name_soundex"}), @ORM\Index(name="city_name_metaphone", columns={"city_name_metaphone"}), @ORM\Index(name="city_population_2010", columns={"city_population_2010"}), @ORM\Index(name="city_name_simple", columns={"city_name_simple"})})
 * @ORM\Entity
 */
class City
{
    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cityId;

    /**
     * @var string
     *
     * @ORM\Column(name="city_departement", type="string", length=3, nullable=true)
     */
    private $cityDepartement;

    /**
     * @var string
     *
     * @ORM\Column(name="city_slug", type="string", length=255, nullable=true)
     */
    private $citySlug;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name", type="string", length=45, nullable=true)
     */
    private $cityName;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name_simple", type="string", length=45, nullable=true)
     */
    private $cityNameSimple;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name_real", type="string", length=45, nullable=true)
     */
    private $cityNameReal;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name_soundex", type="string", length=20, nullable=true)
     */
    private $cityNameSoundex;

    /**
     * @var string
     *
     * @ORM\Column(name="city_name_metaphone", type="string", length=22, nullable=true)
     */
    private $cityNameMetaphone;

    /**
     * @var string
     *
     * @ORM\Column(name="city_zipcode", type="string", length=255, nullable=true)
     */
    private $cityZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city_town", type="string", length=3, nullable=true)
     */
    private $cityTown;

    /**
     * @var string
     *
     * @ORM\Column(name="city_code_town", type="string", length=5, nullable=false)
     */
    private $cityCodeTown;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_arrondissement", type="smallint", nullable=true)
     */
    private $cityArrondissement;

    /**
     * @var string
     *
     * @ORM\Column(name="city_canton", type="string", length=4, nullable=true)
     */
    private $cityCanton;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_amdi", type="smallint", nullable=true)
     */
    private $cityAmdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_population_2010", type="integer", nullable=true)
     */
    private $cityPopulation2010;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_population_1999", type="integer", nullable=true)
     */
    private $cityPopulation1999;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_population_2012", type="integer", nullable=true)
     */
    private $cityPopulation2012;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_densite_2010", type="integer", nullable=true)
     */
    private $cityDensite2010;

    /**
     * @var float
     *
     * @ORM\Column(name="city_surface", type="float", precision=10, scale=0, nullable=true)
     */
    private $citySurface;

    /**
     * @var float
     *
     * @ORM\Column(name="city_longitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $cityLongitudeDeg;

    /**
     * @var float
     *
     * @ORM\Column(name="city_latitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $cityLatitudeDeg;

    /**
     * @var string
     *
     * @ORM\Column(name="city_longitude_grd", type="string", length=9, nullable=true)
     */
    private $cityLongitudeGrd;

    /**
     * @var string
     *
     * @ORM\Column(name="city_latitude_grd", type="string", length=8, nullable=true)
     */
    private $cityLatitudeGrd;

    /**
     * @var string
     *
     * @ORM\Column(name="city_longitude_dms", type="string", length=9, nullable=true)
     */
    private $cityLongitudeDms;

    /**
     * @var string
     *
     * @ORM\Column(name="city_latitude_dms", type="string", length=8, nullable=true)
     */
    private $cityLatitudeDms;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_zmin", type="integer", nullable=true)
     */
    private $cityZmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_zmax", type="integer", nullable=true)
     */
    private $cityZmax;



    /**
     * Get cityId
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * Set cityDepartement
     *
     * @param string $cityDepartement
     *
     * @return City
     */
    public function setCityDepartement($cityDepartement)
    {
        $this->cityDepartement = $cityDepartement;

        return $this;
    }

    /**
     * Get cityDepartement
     *
     * @return string
     */
    public function getCityDepartement()
    {
        return $this->cityDepartement;
    }

    /**
     * Set citySlug
     *
     * @param string $citySlug
     *
     * @return City
     */
    public function setCitySlug($citySlug)
    {
        $this->citySlug = $citySlug;

        return $this;
    }

    /**
     * Get citySlug
     *
     * @return string
     */
    public function getCitySlug()
    {
        return $this->citySlug;
    }

    /**
     * Set cityName
     *
     * @param string $cityName
     *
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set cityNameSimple
     *
     * @param string $cityNameSimple
     *
     * @return City
     */
    public function setCityNameSimple($cityNameSimple)
    {
        $this->cityNameSimple = $cityNameSimple;

        return $this;
    }

    /**
     * Get cityNameSimple
     *
     * @return string
     */
    public function getCityNameSimple()
    {
        return $this->cityNameSimple;
    }

    /**
     * Set cityNameReal
     *
     * @param string $cityNameReal
     *
     * @return City
     */
    public function setCityNameReal($cityNameReal)
    {
        $this->cityNameReal = $cityNameReal;

        return $this;
    }

    /**
     * Get cityNameReal
     *
     * @return string
     */
    public function getCityNameReal()
    {
        return $this->cityNameReal;
    }

    /**
     * Set cityNameSoundex
     *
     * @param string $cityNameSoundex
     *
     * @return City
     */
    public function setCityNameSoundex($cityNameSoundex)
    {
        $this->cityNameSoundex = $cityNameSoundex;

        return $this;
    }

    /**
     * Get cityNameSoundex
     *
     * @return string
     */
    public function getCityNameSoundex()
    {
        return $this->cityNameSoundex;
    }

    /**
     * Set cityNameMetaphone
     *
     * @param string $cityNameMetaphone
     *
     * @return City
     */
    public function setCityNameMetaphone($cityNameMetaphone)
    {
        $this->cityNameMetaphone = $cityNameMetaphone;

        return $this;
    }

    /**
     * Get cityNameMetaphone
     *
     * @return string
     */
    public function getCityNameMetaphone()
    {
        return $this->cityNameMetaphone;
    }

    /**
     * Set cityZipcode
     *
     * @param string $cityZipcode
     *
     * @return City
     */
    public function setCityZipcode($cityZipcode)
    {
        $this->cityZipcode = $cityZipcode;

        return $this;
    }

    /**
     * Get cityZipcode
     *
     * @return string
     */
    public function getCityZipcode()
    {
        return $this->cityZipcode;
    }

    /**
     * Set cityTown
     *
     * @param string $cityTown
     *
     * @return City
     */
    public function setCityTown($cityTown)
    {
        $this->cityTown = $cityTown;

        return $this;
    }

    /**
     * Get cityTown
     *
     * @return string
     */
    public function getCityTown()
    {
        return $this->cityTown;
    }

    /**
     * Set cityCodeTown
     *
     * @param string $cityCodeTown
     *
     * @return City
     */
    public function setCityCodeTown($cityCodeTown)
    {
        $this->cityCodeTown = $cityCodeTown;

        return $this;
    }

    /**
     * Get cityCodeTown
     *
     * @return string
     */
    public function getCityCodeTown()
    {
        return $this->cityCodeTown;
    }

    /**
     * Set cityArrondissement
     *
     * @param integer $cityArrondissement
     *
     * @return City
     */
    public function setCityArrondissement($cityArrondissement)
    {
        $this->cityArrondissement = $cityArrondissement;

        return $this;
    }

    /**
     * Get cityArrondissement
     *
     * @return integer
     */
    public function getCityArrondissement()
    {
        return $this->cityArrondissement;
    }

    /**
     * Set cityCanton
     *
     * @param string $cityCanton
     *
     * @return City
     */
    public function setCityCanton($cityCanton)
    {
        $this->cityCanton = $cityCanton;

        return $this;
    }

    /**
     * Get cityCanton
     *
     * @return string
     */
    public function getCityCanton()
    {
        return $this->cityCanton;
    }

    /**
     * Set cityAmdi
     *
     * @param integer $cityAmdi
     *
     * @return City
     */
    public function setCityAmdi($cityAmdi)
    {
        $this->cityAmdi = $cityAmdi;

        return $this;
    }

    /**
     * Get cityAmdi
     *
     * @return integer
     */
    public function getCityAmdi()
    {
        return $this->cityAmdi;
    }

    /**
     * Set cityPopulation2010
     *
     * @param integer $cityPopulation2010
     *
     * @return City
     */
    public function setCityPopulation2010($cityPopulation2010)
    {
        $this->cityPopulation2010 = $cityPopulation2010;

        return $this;
    }

    /**
     * Get cityPopulation2010
     *
     * @return integer
     */
    public function getCityPopulation2010()
    {
        return $this->cityPopulation2010;
    }

    /**
     * Set cityPopulation1999
     *
     * @param integer $cityPopulation1999
     *
     * @return City
     */
    public function setCityPopulation1999($cityPopulation1999)
    {
        $this->cityPopulation1999 = $cityPopulation1999;

        return $this;
    }

    /**
     * Get cityPopulation1999
     *
     * @return integer
     */
    public function getCityPopulation1999()
    {
        return $this->cityPopulation1999;
    }

    /**
     * Set cityPopulation2012
     *
     * @param integer $cityPopulation2012
     *
     * @return City
     */
    public function setCityPopulation2012($cityPopulation2012)
    {
        $this->cityPopulation2012 = $cityPopulation2012;

        return $this;
    }

    /**
     * Get cityPopulation2012
     *
     * @return integer
     */
    public function getCityPopulation2012()
    {
        return $this->cityPopulation2012;
    }

    /**
     * Set cityDensite2010
     *
     * @param integer $cityDensite2010
     *
     * @return City
     */
    public function setCityDensite2010($cityDensite2010)
    {
        $this->cityDensite2010 = $cityDensite2010;

        return $this;
    }

    /**
     * Get cityDensite2010
     *
     * @return integer
     */
    public function getCityDensite2010()
    {
        return $this->cityDensite2010;
    }

    /**
     * Set citySurface
     *
     * @param float $citySurface
     *
     * @return City
     */
    public function setCitySurface($citySurface)
    {
        $this->citySurface = $citySurface;

        return $this;
    }

    /**
     * Get citySurface
     *
     * @return float
     */
    public function getCitySurface()
    {
        return $this->citySurface;
    }

    /**
     * Set cityLongitudeDeg
     *
     * @param float $cityLongitudeDeg
     *
     * @return City
     */
    public function setCityLongitudeDeg($cityLongitudeDeg)
    {
        $this->cityLongitudeDeg = $cityLongitudeDeg;

        return $this;
    }

    /**
     * Get cityLongitudeDeg
     *
     * @return float
     */
    public function getCityLongitudeDeg()
    {
        return $this->cityLongitudeDeg;
    }

    /**
     * Set cityLatitudeDeg
     *
     * @param float $cityLatitudeDeg
     *
     * @return City
     */
    public function setCityLatitudeDeg($cityLatitudeDeg)
    {
        $this->cityLatitudeDeg = $cityLatitudeDeg;

        return $this;
    }

    /**
     * Get cityLatitudeDeg
     *
     * @return float
     */
    public function getCityLatitudeDeg()
    {
        return $this->cityLatitudeDeg;
    }

    /**
     * Set cityLongitudeGrd
     *
     * @param string $cityLongitudeGrd
     *
     * @return City
     */
    public function setCityLongitudeGrd($cityLongitudeGrd)
    {
        $this->cityLongitudeGrd = $cityLongitudeGrd;

        return $this;
    }

    /**
     * Get cityLongitudeGrd
     *
     * @return string
     */
    public function getCityLongitudeGrd()
    {
        return $this->cityLongitudeGrd;
    }

    /**
     * Set cityLatitudeGrd
     *
     * @param string $cityLatitudeGrd
     *
     * @return City
     */
    public function setCityLatitudeGrd($cityLatitudeGrd)
    {
        $this->cityLatitudeGrd = $cityLatitudeGrd;

        return $this;
    }

    /**
     * Get cityLatitudeGrd
     *
     * @return string
     */
    public function getCityLatitudeGrd()
    {
        return $this->cityLatitudeGrd;
    }

    /**
     * Set cityLongitudeDms
     *
     * @param string $cityLongitudeDms
     *
     * @return City
     */
    public function setCityLongitudeDms($cityLongitudeDms)
    {
        $this->cityLongitudeDms = $cityLongitudeDms;

        return $this;
    }

    /**
     * Get cityLongitudeDms
     *
     * @return string
     */
    public function getCityLongitudeDms()
    {
        return $this->cityLongitudeDms;
    }

    /**
     * Set cityLatitudeDms
     *
     * @param string $cityLatitudeDms
     *
     * @return City
     */
    public function setCityLatitudeDms($cityLatitudeDms)
    {
        $this->cityLatitudeDms = $cityLatitudeDms;

        return $this;
    }

    /**
     * Get cityLatitudeDms
     *
     * @return string
     */
    public function getCityLatitudeDms()
    {
        return $this->cityLatitudeDms;
    }

    /**
     * Set cityZmin
     *
     * @param integer $cityZmin
     *
     * @return City
     */
    public function setCityZmin($cityZmin)
    {
        $this->cityZmin = $cityZmin;

        return $this;
    }

    /**
     * Get cityZmin
     *
     * @return integer
     */
    public function getCityZmin()
    {
        return $this->cityZmin;
    }

    /**
     * Set cityZmax
     *
     * @param integer $cityZmax
     *
     * @return City
     */
    public function setCityZmax($cityZmax)
    {
        $this->cityZmax = $cityZmax;

        return $this;
    }

    /**
     * Get cityZmax
     *
     * @return integer
     */
    public function getCityZmax()
    {
        return $this->cityZmax;
    }
}
