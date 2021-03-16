<?php
namespace Accounts\Core\model;


use Accounts\Core\utils\AccountsUtils;

use Cose\model\impl\Entity;

use Cose\Security\model\User;

use Cose\utils\Logger;

/**
 * Site
 *
 *
 *
 * @Entity @Table(name="accounts_site")
 *
 *  @author Marcos
 * @since 12-03-2021
 */

class Site extends Entity{

    /** @Column(type="string") * */
    private $nombre;

    /** @Column(type="string",nullable=true) * */
    private $logo;

    /** @Column(type="string",nullable=true) * */
    private $mail;

    /** @Column(type="string",nullable=true) * */
    private $description;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }



    /**
     * @ManyToMany(targetEntity="Cose\Security\model\User")
     * @JoinTable(name="accounts_sites_users",
     *      joinColumns={@JoinColumn(name="site_oid", referencedColumnName="oid")},
     *      inverseJoinColumns={@JoinColumn(name="user_oid", referencedColumnName="oid")}
     *      )
     */
    private $users;





    public function __toString()
    {
        return $this->getNombre();
    }

    public function hasSiteuserByName($name){

        $ok = false;

        foreach ($this->getUsers() as $myUser) {
            $ok = strtoupper($myUser->getUsername()) == strtoupper($name);
            if( $ok )
                break;
        }

        return $ok;

    }


}
