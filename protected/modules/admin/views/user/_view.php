<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('UserId')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->UserId), array('view', 'id' => $data->UserId)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('UserType')); ?>:</b>
    <?php echo CHtml::encode($data->UserType); ?>
    <br />
    <?php /* ?>
      <b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
      <?php echo CHtml::encode($data->FirstName); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
      <?php echo CHtml::encode($data->LastName); ?>
      <br />
      <?php */ ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('UserName')); ?>:</b>
    <?php echo CHtml::encode($data->UserName); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
    <?php echo CHtml::encode($data->Email); ?>
    <br />
    <?php /* ?>
      <b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
      <?php echo CHtml::encode($data->Password); ?>
      <br />
      <?php */ ?>


    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('Gender')); ?>:</b>
      <?php echo CHtml::encode($data->Gender); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('BirthDate')); ?>:</b>
      <?php echo CHtml::encode($data->BirthDate); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('AccountVerified')); ?>:</b>
      <?php echo CHtml::encode($data->AccountVerified); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('UserRoles')); ?>:</b>
      <?php echo CHtml::encode($data->UserRoles); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('DeviceId')); ?>:</b>
      <?php echo CHtml::encode($data->DeviceId); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('MobileDeviceId')); ?>:</b>
      <?php echo CHtml::encode($data->MobileDeviceId); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('InsertedDate')); ?>:</b>
      <?php echo CHtml::encode($data->InsertedDate); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedDate')); ?>:</b>
      <?php echo CHtml::encode($data->UpdatedDate); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
      <?php echo CHtml::encode($data->Status); ?>
      <br />

     */ ?>

</div>