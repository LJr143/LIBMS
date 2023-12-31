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

namespace Google\Service\Docs;

class TabStop extends \Google\Model
{
  /**
   * @var string
   */
  public $alignment;
  /**
   * @var Dimension
   */
  public $offset;
  protected $offsetType = Dimension::class;
  protected $offsetDataType = '';

  /**
   * @param string
   */
  public function setAlignment($alignment)
  {
    $this->alignment = $alignment;
  }
  /**
   * @return string
   */
  public function getAlignment()
  {
    return $this->alignment;
  }
  /**
   * @param Dimension
   */
  public function setOffset(Dimension $offset)
  {
    $this->offset = $offset;
  }
  /**
   * @return Dimension
   */
  public function getOffset()
  {
    return $this->offset;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TabStop::class, 'Google_Service_Docs_TabStop');
