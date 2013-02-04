<?php

/**
 * 
 * @author              Duong Dinh Thien<thiendd@peacesoft.net> 
 * @package 		System SaoBang.vn
 * @version 		1.0
 * @since 		
 * @copyright 		PeaceSoft (c) 2012
 *
 */
class EUserIdentity extends CBaseUserIdentity {

    /**
     * @var string email
     */
    public $email;

    /**
     * @var string password
     */
    public $password;

    /**
     * Constructor.
     * @param string $email email
     * @param string $password password
     */
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Authenticates a user based on {@link email} and {@link password}.
     * Derived classes should override this method, or an exception will be thrown.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        throw new CException(Yii::t('yii', '{class}::authenticate() must be implemented.', array('{class}' => get_class($this))));
    }

    /**
     * Returns the unique identifier for the identity.
     * The default implementation simply returns {@link email}.
     * This method is required by {@link IUserIdentity}.
     * @return string the unique identifier for the identity.
     */
    public function getId() {
        return $this->email;
    }

    /**
     * Returns the display name for the identity.
     * The default implementation simply returns {@link email}.
     * This method is required by {@link IUserIdentity}.
     * @return string the display name for the identity.
     */
    public function getName() {
        return $this->email;
    }

}
