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

namespace Google\Service\Compute;

class DiskResourceStatus extends \Google\Model
{
  /**
   * @var DiskResourceStatusAsyncReplicationStatus
   */
  public $asyncPrimaryDisk;
  protected $asyncPrimaryDiskType = DiskResourceStatusAsyncReplicationStatus::class;
  protected $asyncPrimaryDiskDataType = '';
  /**
   * @var DiskResourceStatusAsyncReplicationStatus[]
   */
  public $asyncSecondaryDisks;
  protected $asyncSecondaryDisksType = DiskResourceStatusAsyncReplicationStatus::class;
  protected $asyncSecondaryDisksDataType = 'map';

  /**
   * @param DiskResourceStatusAsyncReplicationStatus
   */
  public function setAsyncPrimaryDisk(DiskResourceStatusAsyncReplicationStatus $asyncPrimaryDisk)
  {
    $this->asyncPrimaryDisk = $asyncPrimaryDisk;
  }
  /**
   * @return DiskResourceStatusAsyncReplicationStatus
   */
  public function getAsyncPrimaryDisk()
  {
    return $this->asyncPrimaryDisk;
  }
  /**
   * @param DiskResourceStatusAsyncReplicationStatus[]
   */
  public function setAsyncSecondaryDisks($asyncSecondaryDisks)
  {
    $this->asyncSecondaryDisks = $asyncSecondaryDisks;
  }
  /**
   * @return DiskResourceStatusAsyncReplicationStatus[]
   */
  public function getAsyncSecondaryDisks()
  {
    return $this->asyncSecondaryDisks;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DiskResourceStatus::class, 'Google_Service_Compute_DiskResourceStatus');
