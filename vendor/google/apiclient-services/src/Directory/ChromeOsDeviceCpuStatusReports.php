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

namespace Google\Service\Directory;

class ChromeOsDeviceCpuStatusReports extends \Google\Collection
{
  protected $collection_key = 'cpuUtilizationPercentageInfo';
  /**
   * @var ChromeOsDeviceCpuStatusReportsCpuTemperatureInfo[]
   */
  public $cpuTemperatureInfo;
  protected $cpuTemperatureInfoType = ChromeOsDeviceCpuStatusReportsCpuTemperatureInfo::class;
  protected $cpuTemperatureInfoDataType = 'array';
  /**
   * @var int[]
   */
  public $cpuUtilizationPercentageInfo;
  /**
   * @var string
   */
  public $reportTime;

  /**
   * @param ChromeOsDeviceCpuStatusReportsCpuTemperatureInfo[]
   */
  public function setCpuTemperatureInfo($cpuTemperatureInfo)
  {
    $this->cpuTemperatureInfo = $cpuTemperatureInfo;
  }
  /**
   * @return ChromeOsDeviceCpuStatusReportsCpuTemperatureInfo[]
   */
  public function getCpuTemperatureInfo()
  {
    return $this->cpuTemperatureInfo;
  }
  /**
   * @param int[]
   */
  public function setCpuUtilizationPercentageInfo($cpuUtilizationPercentageInfo)
  {
    $this->cpuUtilizationPercentageInfo = $cpuUtilizationPercentageInfo;
  }
  /**
   * @return int[]
   */
  public function getCpuUtilizationPercentageInfo()
  {
    return $this->cpuUtilizationPercentageInfo;
  }
  /**
   * @param string
   */
  public function setReportTime($reportTime)
  {
    $this->reportTime = $reportTime;
  }
  /**
   * @return string
   */
  public function getReportTime()
  {
    return $this->reportTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ChromeOsDeviceCpuStatusReports::class, 'Google_Service_Directory_ChromeOsDeviceCpuStatusReports');
