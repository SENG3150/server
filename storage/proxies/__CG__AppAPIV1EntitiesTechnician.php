<?php

namespace DoctrineProxies\__CG__\App\API\V1\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Technician extends \App\API\V1\Entities\Technician implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'username', 'firstName', 'lastName', 'email', 'password', 'temporary', 'loginExpiresTime'];
        }

        return ['__isInitialized__', 'id', 'username', 'firstName', 'lastName', 'email', 'password', 'temporary', 'loginExpiresTime'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Technician $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName($firstName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName($lastName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function isTemporary()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isTemporary', []);

        return parent::isTemporary();
    }

    /**
     * {@inheritDoc}
     */
    public function setTemporary($temporary)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTemporary', [$temporary]);

        return parent::setTemporary($temporary);
    }

    /**
     * {@inheritDoc}
     */
    public function getLoginExpiresTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLoginExpiresTime', []);

        return parent::getLoginExpiresTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setLoginExpiresTime($loginExpiresTime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLoginExpiresTime', [$loginExpiresTime]);

        return parent::setLoginExpiresTime($loginExpiresTime);
    }

    /**
     * {@inheritDoc}
     */
    public function getName($salutation = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', [$salutation]);

        return parent::getName($salutation);
    }

    /**
     * {@inheritDoc}
     */
    public function matchesPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'matchesPassword', [$password]);

        return parent::matchesPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($index)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetExists', [$index]);

        return parent::offsetExists($index);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($index)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetGet', [$index]);

        return parent::offsetGet($index);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($index, $newval)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetSet', [$index, $newval]);

        return parent::offsetSet($index, $newval);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($index)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetUnset', [$index]);

        return parent::offsetUnset($index);
    }

    /**
     * {@inheritDoc}
     */
    public function append($value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'append', [$value]);

        return parent::append($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getArrayCopy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrayCopy', []);

        return parent::getArrayCopy();
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'count', []);

        return parent::count();
    }

    /**
     * {@inheritDoc}
     */
    public function getFlags()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFlags', []);

        return parent::getFlags();
    }

    /**
     * {@inheritDoc}
     */
    public function setFlags($flags)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFlags', [$flags]);

        return parent::setFlags($flags);
    }

    /**
     * {@inheritDoc}
     */
    public function asort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'asort', []);

        return parent::asort();
    }

    /**
     * {@inheritDoc}
     */
    public function ksort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'ksort', []);

        return parent::ksort();
    }

    /**
     * {@inheritDoc}
     */
    public function uasort($cmp_function)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'uasort', [$cmp_function]);

        return parent::uasort($cmp_function);
    }

    /**
     * {@inheritDoc}
     */
    public function uksort($cmp_function)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'uksort', [$cmp_function]);

        return parent::uksort($cmp_function);
    }

    /**
     * {@inheritDoc}
     */
    public function natsort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'natsort', []);

        return parent::natsort();
    }

    /**
     * {@inheritDoc}
     */
    public function natcasesort()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'natcasesort', []);

        return parent::natcasesort();
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unserialize', [$serialized]);

        return parent::unserialize($serialized);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', []);

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIterator', []);

        return parent::getIterator();
    }

    /**
     * {@inheritDoc}
     */
    public function exchangeArray($array)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'exchangeArray', [$array]);

        return parent::exchangeArray($array);
    }

    /**
     * {@inheritDoc}
     */
    public function setIteratorClass($iteratorClass)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIteratorClass', [$iteratorClass]);

        return parent::setIteratorClass($iteratorClass);
    }

    /**
     * {@inheritDoc}
     */
    public function getIteratorClass()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIteratorClass', []);

        return parent::getIteratorClass();
    }

}
