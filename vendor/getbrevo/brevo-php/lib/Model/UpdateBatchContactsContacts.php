<?php
/**
 * UpdateBatchContactsContacts
 *
 * PHP version 5
 *
 * @category Class
 * @package  Brevo\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Brevo API
 *
 * Brevo provide a RESTFul API that can be used with any languages. With this API, you will be able to :   - Manage your campaigns and get the statistics   - Manage your contacts   - Send transactional Emails and SMS   - and much more...  You can download our wrappers at https://github.com/orgs/brevo  **Possible responses**   | Code | Message |   | :-------------: | ------------- |   | 200  | OK. Successful Request  |   | 201  | OK. Successful Creation |   | 202  | OK. Request accepted |   | 204  | OK. Successful Update/Deletion  |   | 400  | Error. Bad Request  |   | 401  | Error. Authentication Needed  |   | 402  | Error. Not enough credit, plan upgrade needed  |   | 403  | Error. Permission denied  |   | 404  | Error. Object does not exist |   | 405  | Error. Method not allowed  |   | 406  | Error. Not Acceptable  |
 *
 * OpenAPI spec version: 3.0.0
 * Contact: contact@brevo.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.29
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Brevo\Client\Model;

use \ArrayAccess;
use \Brevo\Client\ObjectSerializer;

/**
 * UpdateBatchContactsContacts Class Doc Comment
 *
 * @category Class
 * @package  Brevo\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UpdateBatchContactsContacts implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'updateBatchContacts_contacts';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'email' => 'string',
        'id' => 'int',
        'sms' => 'string',
        'extId' => 'string',
        'attributes' => 'map[string,object]',
        'emailBlacklisted' => 'bool',
        'smsBlacklisted' => 'bool',
        'listIds' => 'int[]',
        'unlinkListIds' => 'int[]',
        'smtpBlacklistSender' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'email' => 'email',
        'id' => 'int64',
        'sms' => null,
        'extId' => null,
        'attributes' => null,
        'emailBlacklisted' => null,
        'smsBlacklisted' => null,
        'listIds' => 'int64',
        'unlinkListIds' => 'int64',
        'smtpBlacklistSender' => 'email'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'email' => 'email',
        'id' => 'id',
        'sms' => 'sms',
        'extId' => 'ext_id',
        'attributes' => 'attributes',
        'emailBlacklisted' => 'emailBlacklisted',
        'smsBlacklisted' => 'smsBlacklisted',
        'listIds' => 'listIds',
        'unlinkListIds' => 'unlinkListIds',
        'smtpBlacklistSender' => 'smtpBlacklistSender'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'email' => 'setEmail',
        'id' => 'setId',
        'sms' => 'setSms',
        'extId' => 'setExtId',
        'attributes' => 'setAttributes',
        'emailBlacklisted' => 'setEmailBlacklisted',
        'smsBlacklisted' => 'setSmsBlacklisted',
        'listIds' => 'setListIds',
        'unlinkListIds' => 'setUnlinkListIds',
        'smtpBlacklistSender' => 'setSmtpBlacklistSender'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'email' => 'getEmail',
        'id' => 'getId',
        'sms' => 'getSms',
        'extId' => 'getExtId',
        'attributes' => 'getAttributes',
        'emailBlacklisted' => 'getEmailBlacklisted',
        'smsBlacklisted' => 'getSmsBlacklisted',
        'listIds' => 'getListIds',
        'unlinkListIds' => 'getUnlinkListIds',
        'smtpBlacklistSender' => 'getSmtpBlacklistSender'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['sms'] = isset($data['sms']) ? $data['sms'] : null;
        $this->container['extId'] = isset($data['extId']) ? $data['extId'] : null;
        $this->container['attributes'] = isset($data['attributes']) ? $data['attributes'] : null;
        $this->container['emailBlacklisted'] = isset($data['emailBlacklisted']) ? $data['emailBlacklisted'] : null;
        $this->container['smsBlacklisted'] = isset($data['smsBlacklisted']) ? $data['smsBlacklisted'] : null;
        $this->container['listIds'] = isset($data['listIds']) ? $data['listIds'] : null;
        $this->container['unlinkListIds'] = isset($data['unlinkListIds']) ? $data['unlinkListIds'] : null;
        $this->container['smtpBlacklistSender'] = isset($data['smtpBlacklistSender']) ? $data['smtpBlacklistSender'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email Email address of the user to be updated (For each operation only pass one of the supported contact identifiers. Email, id or sms)
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id of the user to be updated (For each operation only pass one of the supported contact identifiers. Email, id or sms)
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets sms
     *
     * @return string
     */
    public function getSms()
    {
        return $this->container['sms'];
    }

    /**
     * Sets sms
     *
     * @param string $sms SMS of the user to be updated (For each operation only pass one of the supported contact identifiers. Email, id or sms)
     *
     * @return $this
     */
    public function setSms($sms)
    {
        $this->container['sms'] = $sms;

        return $this;
    }

    /**
     * Gets extId
     *
     * @return string
     */
    public function getExtId()
    {
        return $this->container['extId'];
    }

    /**
     * Sets extId
     *
     * @param string $extId Pass your own Id to update ext_id of a contact.
     *
     * @return $this
     */
    public function setExtId($extId)
    {
        $this->container['extId'] = $extId;

        return $this;
    }

    /**
     * Gets attributes
     *
     * @return map[string,object]
     */
    public function getAttributes()
    {
        return $this->container['attributes'];
    }

    /**
     * Sets attributes
     *
     * @param map[string,object] $attributes Pass the set of attributes to be updated. **These attributes must be present in your account**. To update existing email address of a contact with the new one please pass EMAIL in attribtes. For example, **{ \"EMAIL\":\"newemail@domain.com\", \"FNAME\":\"Ellie\", \"LNAME\":\"Roger\"}**. Keep in mind transactional attributes can be updated the same way as normal attributes. Mobile Number in **SMS** field should be passed with proper country code. For example: **{\"SMS\":\"+91xxxxxxxxxx\"} or {\"SMS\":\"0091xxxxxxxxxx\"}**
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->container['attributes'] = $attributes;

        return $this;
    }

    /**
     * Gets emailBlacklisted
     *
     * @return bool
     */
    public function getEmailBlacklisted()
    {
        return $this->container['emailBlacklisted'];
    }

    /**
     * Sets emailBlacklisted
     *
     * @param bool $emailBlacklisted Set/unset this field to blacklist/allow the contact for emails (emailBlacklisted = true)
     *
     * @return $this
     */
    public function setEmailBlacklisted($emailBlacklisted)
    {
        $this->container['emailBlacklisted'] = $emailBlacklisted;

        return $this;
    }

    /**
     * Gets smsBlacklisted
     *
     * @return bool
     */
    public function getSmsBlacklisted()
    {
        return $this->container['smsBlacklisted'];
    }

    /**
     * Sets smsBlacklisted
     *
     * @param bool $smsBlacklisted Set/unset this field to blacklist/allow the contact for SMS (smsBlacklisted = true)
     *
     * @return $this
     */
    public function setSmsBlacklisted($smsBlacklisted)
    {
        $this->container['smsBlacklisted'] = $smsBlacklisted;

        return $this;
    }

    /**
     * Gets listIds
     *
     * @return int[]
     */
    public function getListIds()
    {
        return $this->container['listIds'];
    }

    /**
     * Sets listIds
     *
     * @param int[] $listIds Ids of the lists to add the contact to
     *
     * @return $this
     */
    public function setListIds($listIds)
    {
        $this->container['listIds'] = $listIds;

        return $this;
    }

    /**
     * Gets unlinkListIds
     *
     * @return int[]
     */
    public function getUnlinkListIds()
    {
        return $this->container['unlinkListIds'];
    }

    /**
     * Sets unlinkListIds
     *
     * @param int[] $unlinkListIds Ids of the lists to remove the contact from
     *
     * @return $this
     */
    public function setUnlinkListIds($unlinkListIds)
    {
        $this->container['unlinkListIds'] = $unlinkListIds;

        return $this;
    }

    /**
     * Gets smtpBlacklistSender
     *
     * @return string[]
     */
    public function getSmtpBlacklistSender()
    {
        return $this->container['smtpBlacklistSender'];
    }

    /**
     * Sets smtpBlacklistSender
     *
     * @param string[] $smtpBlacklistSender transactional email forbidden sender for contact. Use only for email Contact
     *
     * @return $this
     */
    public function setSmtpBlacklistSender($smtpBlacklistSender)
    {
        $this->container['smtpBlacklistSender'] = $smtpBlacklistSender;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


