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

namespace Google\Service\ServiceManagement;

class SubmitConfigSourceResponse extends \Google\Model
{
  /**
   * @var Service
   */
  public $serviceConfig;
  protected $serviceConfigType = Service::class;
  protected $serviceConfigDataType = '';

  /**
   * @param Service
   */
  public function setServiceConfig(Service $serviceConfig)
  {
    $this->serviceConfig = $serviceConfig;
  }
  /**
   * @return Service
   */
  public function getServiceConfig()
  {
    return $this->serviceConfig;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SubmitConfigSourceResponse::class, 'Google_Service_ServiceManagement_SubmitConfigSourceResponse');
