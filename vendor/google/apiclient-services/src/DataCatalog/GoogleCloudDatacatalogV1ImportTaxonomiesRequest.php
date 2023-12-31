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

namespace Google\Service\DataCatalog;

class GoogleCloudDatacatalogV1ImportTaxonomiesRequest extends \Google\Model
{
  /**
   * @var GoogleCloudDatacatalogV1CrossRegionalSource
   */
  public $crossRegionalSource;
  protected $crossRegionalSourceType = GoogleCloudDatacatalogV1CrossRegionalSource::class;
  protected $crossRegionalSourceDataType = '';
  /**
   * @var GoogleCloudDatacatalogV1InlineSource
   */
  public $inlineSource;
  protected $inlineSourceType = GoogleCloudDatacatalogV1InlineSource::class;
  protected $inlineSourceDataType = '';

  /**
   * @param GoogleCloudDatacatalogV1CrossRegionalSource
   */
  public function setCrossRegionalSource(GoogleCloudDatacatalogV1CrossRegionalSource $crossRegionalSource)
  {
    $this->crossRegionalSource = $crossRegionalSource;
  }
  /**
   * @return GoogleCloudDatacatalogV1CrossRegionalSource
   */
  public function getCrossRegionalSource()
  {
    return $this->crossRegionalSource;
  }
  /**
   * @param GoogleCloudDatacatalogV1InlineSource
   */
  public function setInlineSource(GoogleCloudDatacatalogV1InlineSource $inlineSource)
  {
    $this->inlineSource = $inlineSource;
  }
  /**
   * @return GoogleCloudDatacatalogV1InlineSource
   */
  public function getInlineSource()
  {
    return $this->inlineSource;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDatacatalogV1ImportTaxonomiesRequest::class, 'Google_Service_DataCatalog_GoogleCloudDatacatalogV1ImportTaxonomiesRequest');
