<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\CloudSearch;

class ErrorInfo extends \Google\Collection
{
  protected $collection_key = 'errorMessages';
  /**
   * @var ErrorMessage[]
   */
  public $errorMessages;
  protected $errorMessagesType = ErrorMessage::class;
  protected $errorMessagesDataType = 'array';

  /**
   * @param ErrorMessage[]
   */
  public function setErrorMessages($errorMessages)
  {
    $this->errorMessages = $errorMessages;
  }
  /**
   * @return ErrorMessage[]
   */
  public function getErrorMessages()
  {
    return $this->errorMessages;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ErrorInfo::class, 'Google_Service_CloudSearch_ErrorInfo');
