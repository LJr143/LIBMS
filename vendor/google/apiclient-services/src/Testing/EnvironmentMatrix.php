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

namespace Google\Service\Testing;

class EnvironmentMatrix extends \Google\Model
{
  /**
   * @var AndroidDeviceList
   */
  public $androidDeviceList;
  protected $androidDeviceListType = AndroidDeviceList::class;
  protected $androidDeviceListDataType = '';
  /**
   * @var AndroidMatrix
   */
  public $androidMatrix;
  protected $androidMatrixType = AndroidMatrix::class;
  protected $androidMatrixDataType = '';
  /**
   * @var IosDeviceList
   */
  public $iosDeviceList;
  protected $iosDeviceListType = IosDeviceList::class;
  protected $iosDeviceListDataType = '';

  /**
   * @param AndroidDeviceList
   */
  public function setAndroidDeviceList(AndroidDeviceList $androidDeviceList)
  {
    $this->androidDeviceList = $androidDeviceList;
  }
  /**
   * @return AndroidDeviceList
   */
  public function getAndroidDeviceList()
  {
    return $this->androidDeviceList;
  }
  /**
   * @param AndroidMatrix
   */
  public function setAndroidMatrix(AndroidMatrix $androidMatrix)
  {
    $this->androidMatrix = $androidMatrix;
  }
  /**
   * @return AndroidMatrix
   */
  public function getAndroidMatrix()
  {
    return $this->androidMatrix;
  }
  /**
   * @param IosDeviceList
   */
  public function setIosDeviceList(IosDeviceList $iosDeviceList)
  {
    $this->iosDeviceList = $iosDeviceList;
  }
  /**
   * @return IosDeviceList
   */
  public function getIosDeviceList()
  {
    return $this->iosDeviceList;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EnvironmentMatrix::class, 'Google_Service_Testing_EnvironmentMatrix');
