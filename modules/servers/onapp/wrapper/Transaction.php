<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Transactions
 *
 * The system records in the database a detailed log of all the transactions
 * happening to your virtual machines. You can view the transactions output from
 * the Control Panel.
 *
 * @category  API WRAPPER
 * @package   ONAPP
 * @author    Andrew Yatskovets
 * @copyright 2010 / OnApp
 * @link      http://www.onapp.com/
 * @see       ONAPP
 */

/**
 * requires Base class
 */
require_once 'ONAPP.php';

/**
 * Transactions
 *
 * This class represents the Transactions of the OnApp installation.
 *
 * The ONAPP_Transaction class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of transactions
 *
 *     - <i>GET onapp.com/transactions.xml</i>
 *
 * Get a particular transaction details
 *
 *     - <i>GET onapp.com/transactions/{ID}.xml</i>
 *
 * Add new transaction
 *
 *     - <i>POST onapp.com/transactions.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <transactions>
 *    <!-- TODO add description -->
 * </transactions>
 * </code>
 *
 * Edit existing transaction
 *
 *     - <i>PUT onapp.com/transactions/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <transactions>
 *    <!-- TODO add description -->
 * </transactions>
 * </code>
 *
 * Delete transaction
 *
 *     - <i>DELETE onapp.com/transactions/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of transactions
 *
 *     - <i>GET onapp.com/transactions.json</i>
 *
 * Get a particular transaction details
 *
 *     - <i>GET onapp.com/transactions/{ID}.json</i>
 *
 * Add new transaction
 *
 *     - <i>POST onapp.com/transactions.json</i>
 *
 * <code>
 * {
 *      transactions: {
 *          # TODO add description
 *      }
 * }
 * </code>
 *
 * Edit existing transaction
 *
 *     - <i>PUT onapp.com/transactions/{ID}.json</i>
 *
 * <code>
 * {
 *      transactions: {
 *          # TODO add description
 *      }
 * }
 * </code>
 *
 * Delete transaction
 *
 *     - <i>DELETE onapp.com/transactions/{ID}.json</i>
 */
class ONAPP_Transaction extends ONAPP {

    /**
     * the transaction ID
     *
     * @var integer
     */
    var $_id;

    /**
     * the action this transaction represents
     *
     * @var integer
     */
    var $_action;

    /**
     * who performed this transaction
     *
     * @var integer
     */
    var $_actor;

    /**
     * the transaction date in the [YYYY][MM][DD]T[hh][mm]Z format
     *
     * @var string
     */
    var $_created_at;

    /**
     * the ID of the dependent transaction
     *
     * @var integer
     */
    var $_dependent_transaction_id;

    /**
     * the log message output
     *
     * @var integer
     */
    var $_log_output;

    /**
     *
     * @todo yaml format
     * @var integer
     */
    var $_params;

    /**
     * The ID of the parent
     *
     * @var integer
     */
    var $_parent_id;

    /**
     * The parent process type
     *
     * @var integer
     */
    var $_parent_type;

    /**
     * The ID of the parent process
     *
     * @var integer
     */
    var $_pid;

    /**
     * The process priority
     *
     * @var integer
     */
    var $_priority;

    /**
     * The process stats
     *
     * @var integer
     */
    var $_status;

    /**
     * the transaction update date in the [YYYY][MM][DD]T[hh][mm]Z format
     *
     * @var string
     */
    var $_updated_at;

    /**
     * The User ID
     *
     * @var integer
     */
    var $_user_id;

    /**
     * shows whether cancellation is allowed
     *
     * @var boolean
     */
    var $_allowed_cancel;

    /**
     * transaction identifier
     *
     * @var string
     */
    var $_identifier;

    /**
     * the start after date in the [YYYY][MM][DD]T[hh][mm]Z format
     *
     * @var string
     */
    var $_start_after;

    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'transactions';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'transactions';

    /**
     *
     * called class name
     *
     * @var string
     */
    var $_called_class = 'ONAPP_Transaction';

    /**
     * API Fields description
     *
     * @access private
     * @var    array
     */
    function _init_fields( $version = NULL ) {
        if( !isset( $this->options[ ONAPP_OPTION_API_TYPE ] ) || ( $this->options[ ONAPP_OPTION_API_TYPE ] == 'json' ) ) {
            $this->_tagRoot = 'transaction';
        }

        if( is_null( $version ) ) {
            $version = $this->_version;
        }

        switch( $version ) {
            case '2.0':
                $this->_fields = array(
                    'id' => array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'action' => array(
                        ONAPP_FIELD_MAP => '_action',
                        ONAPP_FIELD_DEFAULT_VALUE => '',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'actor' => array(
                        ONAPP_FIELD_MAP => '_actor',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'dependent_transaction_id' => array(
                        ONAPP_FIELD_MAP => '_dependent_transaction_id',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'log_output' => array(
                        ONAPP_FIELD_MAP => '_log_output',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'params' => array(
                        ONAPP_FIELD_MAP => '_params',
                        ONAPP_FIELD_TYPE => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'parent_id' => array(
                        ONAPP_FIELD_MAP => '_parent_id',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'parent_type' => array(
                        ONAPP_FIELD_MAP => '_parent_type',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'pid' => array(
                        ONAPP_FIELD_MAP => '_pid',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'priority' => array(
                        ONAPP_FIELD_MAP => '_priority',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'status' => array(
                        ONAPP_FIELD_MAP => '_status',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'user_id' => array(
                        ONAPP_FIELD_MAP => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );

                break;

            case '2.1':
                $this->_fields = $this->_init_fields('2.0');

                $this->_fields[ 'allowed_cancel' ] = array(
                    ONAPP_FIELD_MAP => '_allowed_cancel',
                    ONAPP_FIELD_TYPE => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true
                );

                $this->_fields[ 'identifier' ] = array(
                    ONAPP_FIELD_MAP => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                    ONAPP_FIELD_READ_ONLY => true
                );

                $this->_fields[ 'start_after' ] = array(
                    ONAPP_FIELD_MAP => '_start_after',
                    ONAPP_FIELD_TYPE => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true
                );

                break;
        }

        return $this->_fields;
    }

    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                die( "Call to undefined method " . __CLASS__ . "::$action_name()" );
                break;
        }
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @return the array of Object instances
     * @access public
     */
     function getList( $page = 1 ) {
        $this->activate( ONAPP_ACTIVATE_GETLIST );

        $this->_loger->add( "getList: Get Transaction list." );

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LIST ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET, '{"page":"'.$page.'"}' );

        if( !empty( $response[ 'errors' ] ) ) {
            $this->error = $response[ 'errors' ];
            return false;
        }

        return $this->castStringToClass(
            $response[ "response_body" ],
            true
        );
    }

}

?>
