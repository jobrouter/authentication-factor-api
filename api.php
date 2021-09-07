<?php

namespace JobRouter\Plugin { if(false) { 
    class ExtensionRegistry
    {
    }
    class ExtensionTypeOperator
    {
        public function __construct(\JobRouter\Plugin\ExtensionRegistry $registry)
        {
        }
        public function registerAuthenticationFactor(string $factorType, string $className)
        {
        }
        public function registerTranslations(string $path)
        {
        }
    }
 }}
namespace JobRouter\Log { if(false) { 
    /**
     * Describes a logger instance.
     *
     * The message MUST be a string or object implementing __toString().
     *
     * The message MAY contain placeholders in the form: {foo} where foo
     * will be replaced by the context data in key "foo".
     *
     * The context array can contain arbitrary data. The only assumption that
     * can be made by implementors is that if an Exception instance is given
     * to produce a stack trace, it MUST be in a key named "exception".
     *
     * See https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
     * for the full interface specification.
     */
    interface LoggerInterface
    {
        /**
         * System is unusable.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function emergency($message, array $context = []);
        /**
         * Action must be taken immediately.
         *
         * Example: Entire website down, database unavailable, etc. This should
         * trigger the SMS alerts and wake you up.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function alert($message, array $context = []);
        /**
         * Critical conditions.
         *
         * Example: Application component unavailable, unexpected exception.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function critical($message, array $context = []);
        /**
         * Runtime errors that do not require immediate action but should typically
         * be logged and monitored.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function error($message, array $context = []);
        /**
         * Exceptional occurrences that are not errors.
         *
         * Example: Use of deprecated APIs, poor use of an API, undesirable things
         * that are not necessarily wrong.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function warning($message, array $context = []);
        /**
         * Normal but significant events.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function notice($message, array $context = []);
        /**
         * Interesting events.
         *
         * Example: User logs in, SQL logs.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function info($message, array $context = []);
        /**
         * Detailed debug information.
         *
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function debug($message, array $context = []);
        /**
         * Logs with an arbitrary level.
         *
         * @param mixed $level
         * @param string $message
         * @param mixed[] $context
         *
         * @return void
         */
        public function log($level, $message, array $context = []);
    }
 }}
namespace JobRouter\Plugin { if(false) { 
    interface PluginInterface
    {
        public function load(\JobRouter\Plugin\ExtensionRegistry $registry) : void;
    }
 }}
namespace JobRouter\Authentication\Factor\Wizard { if(false) { 
    /**
     * A message displayed to the user on top of the login screen.
     */
    abstract class Message
    {
        public function __construct(string $text)
        {
        }
        public abstract function getType() : string;
        public final function getText() : string
        {
        }
    }
    /**
     * Information about errors during the authentication process.
     * Usually these require some action by the user or administrator.
     */
    final class ErrorMessage extends \JobRouter\Authentication\Factor\Wizard\Message
    {
        /**
         * @return string
         */
        public function getType() : string
        {
        }
    }
    /**
     * A form field displayed on the login page.
     * Requires some input by the user, e.g. a 2FA PIN.
     */
    abstract class Field
    {
        public function __construct(string $name, string $label = '')
        {
        }
        public abstract function getType() : string;
        public final function getName() : string
        {
        }
        public final function getLabel() : string
        {
        }
    }
    /**
     * General information during the authentication process.
     */
    final class InfoMessage extends \JobRouter\Authentication\Factor\Wizard\Message
    {
        public function getType() : string
        {
        }
    }
    /**
     * A link displayed at the bottom of the login page.
     */
    final class Link
    {
        public function __construct(string $target, string $label)
        {
        }
        public function getTarget() : string
        {
        }
        public function getLabel() : string
        {
        }
    }
    /**
     * A form field for numerical input.
     */
    final class NumberField extends \JobRouter\Authentication\Factor\Wizard\Field
    {
        public function getType() : string
        {
        }
    }
    /**
     * A form field for text input.
     */
    final class TextField extends \JobRouter\Authentication\Factor\Wizard\Field
    {
        public function getType() : string
        {
        }
    }
 }}
namespace JobRouter\Authentication { if(false) { 
    interface AuthenticationFactorInterface
    {
        /**
         * Execute authentication factor.
         *
         * The runtime provides access to the current session data related to the authentication process.
         * It also includes a method to determine the current factor (stage).
         *
         * @param Runtime $runtime
         *
         * @throws AuthenticationFactorFailedException
         */
        public function execute(\JobRouter\Authentication\Runtime $runtime) : void;
        /**
         * Check authentication factor for validity
         *
         * If factor is invalid, throw AuthenticationFactorFailedException with a corresponding message. The message will be shown on the login page.
         *
         * @param Runtime $runtime
         *
         * @throws AuthenticationFactorFailedException
         */
        public function check(\JobRouter\Authentication\Runtime $runtime) : void;
        /**
         * This method will be called when the checkFactor method throws an AuthenticationFactorFailedException (factor check was unsuccessful)
         *
         * @param Runtime $runtime
         */
        public function handleInvalidFactor(\JobRouter\Authentication\Runtime $runtime) : void;
        /**
         * @return \JobRouter\Authentication\Factor\Wizard\Field[]
         */
        public function getFields() : array;
        /**
         * @return \JobRouter\Authentication\Factor\Wizard\Message[]
         */
        public function getMessages() : array;
        /**
         * @return \JobRouter\Authentication\Factor\Wizard\Link[]
         */
        public function getLinks() : array;
        /**
         * This method returns the label used in the UserProfile configuration.
         *
         * @return string
         */
        public function getConfigurationLabel() : string;
        /**
         * This method defines whether the authentication factor is available or not.
         *
         * @return bool
         */
        public function isAvailable() : bool;
    }
    final class Runtime
    {
        /**
         * Set a variable in the user session in the browser.
         *
         * @param string $key
         * @param string $value
         */
        public function setSessionVariable(string $key, string $value) : void
        {
        }
        /**
         * Get the value of the session variable with the given key.
         *
         * @param string $key
         *
         * @return string|null
         */
        public function getSessionVariable(string $key) : ?string
        {
        }
        /**
         * Delete the session variable with the given key.
         * This should be done at the end of the authentication process.
         *
         * @param string $key
         */
        public function deleteSessionVariable(string $key) : void
        {
        }
        /**
         * Returns the user in the current authentication process.
         *
         * @return \JobRouter\Api\User\ApiUser
         */
        public function getUser() : \JobRouter\Api\User\ApiUser
        {
        }
        /**
         * Returns the value of the specified request parameter.
         * When using Fields in your authentication process, these will
         * be specified by the name used to instantiate the Field object.
         *
         * @param string $name
         *
         * @return string|null
         */
        public function getRequestParameter(string $name) : ?string
        {
        }
        /**
         * Returns a logger object that can be used to log events
         * for the system administrators.
         *
         * @return \JobRouter\Log\LoggerInterface
         */
        public function getLogger() : \JobRouter\Log\LoggerInterface
        {
        }
        /**
         * Returns a formatted date string.
         * ID can be specified explicitly, or e.g. the method getDateFormatId of the ApiUser class
         * can be used to get the current user's date format.
         *
         * @param int $id 1 (DD.MM.YYYY), 2 (DD/MM/YYYY), 3 (MM/DD/YYYY), 4 (YYYY-MM-DD)
         * @param string|false $date Date string, datetime string, timestamp as string, or false to use the current datetime
         * @param false $isTimestamp Specifies if the value in $date is a timestamp
         * @param false $fullDateTime Specifies if the time should be considered in addition to the date
         * @param string $timezone Timezone name or offset value (e.g. +0200)
         *
         * @return string
         */
        public function getFormattedDate(int $id, $date = false, bool $isTimestamp = false, bool $fullDateTime = false, string $timezone = '') : string
        {
        }
        /**
         * Returns a "Back to login" link that resets the current authentication process.
         * If no label is provided, a default translation is used.
         *
         * @param string|null $label
         *
         * @return \JobRouter\Authentication\Factor\Wizard\Link
         */
        public function getResetAuthenticationProcessLink(?string $label = CONST_BACK_TO_LOGIN_PAGE) : \JobRouter\Authentication\Factor\Wizard\Link
        {
        }
        /**
         * Returns a link that repeats the current factor within the authentication process.
         * This action will trigger the execute method of your Authentication Factor class an additional time,
         * and the user will remain in the current step of the authentication process.
         *
         * @param string $label
         *
         * @return \JobRouter\Authentication\Factor\Wizard\Link
         */
        public function getRepeatFactorLink(string $label) : \JobRouter\Authentication\Factor\Wizard\Link
        {
        }
    }
 }}
namespace JobRouter\Api\User { if(false) { 
    class ApiUser
    {
        /**
         * Returns the current user's username.
         *
         * @return string
         */
        public function getUsername() : string
        {
        }
        /**
         * Returns the current user's job functions in an array of strings.
         * If an error occurs during the database query to fetch the job functions,
         * a JobRouterException containing the DB error message is thrown.
         *
         * @return array
         * @throws \JobRouterException
         */
        public function getJobFunctions() : array
        {
        }
        /**
         * Checks whether the current user is in the specified job function.
         * If an error occurs during the database query to fetch the job functions,
         * a JobRouterException containing the DB error message is thrown.
         *
         * @param string $jobfunction
         *
         * @return bool
         * @throws \JobRouterException
         */
        public function isInJobFunction(string $jobfunction) : bool
        {
        }
        /**
         * Checks whether the current user has administrator rights.
         *
         * @return bool
         */
        public function hasAdminRights() : bool
        {
        }
        /**
         * Checks whether the current user is the owner of any processes.
         * If an error occurs during the database query to fetch the processes,
         * a JobRouterException containing the DB error message is thrown.
         *
         * @return bool
         * @throws \JobRouterException
         */
        public function hasOwnProcesses() : bool
        {
        }
        /**
         * Returns the current user's last name.
         *
         * @return string
         */
        public function getLastname() : string
        {
        }
        /**
         * Returns the current user's first name.
         *
         * @return string
         */
        public function getPrename() : string
        {
        }
        /**
         * Returns the current user's e-mail address.
         *
         * @return string
         */
        public function getEmail() : string
        {
        }
        /**
         * Returns the current user's department.
         *
         * @return string
         */
        public function getDepartment() : string
        {
        }
        /**
         * Returns the username of the current user's supervisor.
         *
         * @return string
         */
        public function getSupervisor() : string
        {
        }
        /**
         * Returns the current user's user defined 1 field.
         *
         * @return string
         */
        public function getUserDefined1() : string
        {
        }
        /**
         * Returns the current user's user defined 2 field.
         *
         * @return string
         */
        public function getUserDefined2() : string
        {
        }
        /**
         * Returns the current user's user defined 3 field.
         *
         * @return string
         */
        public function getUserDefined3() : string
        {
        }
        /**
         * Returns the current user's user defined 4 field.
         *
         * @return string
         */
        public function getUserDefined4() : string
        {
        }
        /**
         * Returns the current user's user defined 5 field.
         *
         * @return string
         */
        public function getUserDefined5() : string
        {
        }
        /**
         * Returns the URL of the current user's avatar.
         *
         * @return string
         */
        public function getAvatarUrl() : string
        {
        }
        /**
         * Returns the decimal separator as configured in the current user's settings.
         *
         * @return string
         */
        public function getDecimalSeparator() : string
        {
        }
        /**
         * Returns the thousands separator as configured in the current user's settings.
         *
         * @return string
         */
        public function getThousandsSeparator() : string
        {
        }
        /**
         * Returns the current user's language.
         *
         * @return string
         */
        public function getLanguage() : string
        {
        }
        /**
         * Returns the current user's full name.
         *
         * @return string
         */
        public function getFullName() : string
        {
        }
        /**
         * Returns the current user's date format as specified in their settings.
         * If an invalid date format is configured, a default value of YYYY-MM-DD HH:mm:ss is returned.
         *
         * @return string
         */
        public function getDateFormat() : string
        {
        }
        /**
         * Returns the corresponding ID of the current user's date format.
         * This ID can be used, for example, in the getFormattedDate method of the Runtime class
         * to format a date according to the current user's configured date format.
         *
         * @return int
         */
        public function getDateFormatId() : int
        {
        }
        
    }
 }}
namespace { if(false) { 
    class JobRouterException extends \Exception
    {
        public function __construct($message, $code = 0, \Throwable $previous = \null)
        {
        }
    }
 }}
namespace JobRouter\Authentication { if(false) { 
    abstract class AuthenticationException extends \JobRouterException
    {
    }
    class AuthenticationFailedException extends \JobRouter\Authentication\AuthenticationException
    {
    }
    class AuthenticationFactorFailedException extends \JobRouter\Authentication\AuthenticationFailedException
    {
    }
 }}