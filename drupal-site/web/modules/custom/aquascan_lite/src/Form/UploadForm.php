<?php

namespace Drupal\aquascan_lite\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for uploading CSV data to AquaScan.
 */
class UploadForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aquascan_lite_upload_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['csv_file'] = [
      '#type' => 'file',
      '#title' => $this->t('CSV file'),
      '#description' => $this->t('Upload a CSV containing water, energy and production values.'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Upload'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Basic placeholder: we won't actually process the file in this demo.
    $validators = ['file_validate_extensions' => ['csv']];
    if ($file = file_save_upload('csv_file', $validators, FALSE, 0)) {
      $this->messenger()->addStatus($this->t('File %name uploaded successfully.', ['%name' => $file->getFilename()]));
    }
    else {
      $this->messenger()->addError($this->t('Failed to upload file.'));    
    }
  }

}
