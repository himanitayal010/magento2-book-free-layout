<?php

namespace Magneto\BookLayout\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magneto\BookLayout\Model\BookLayoutFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;

class Save extends \Magento\Framework\App\Action\Action
{
	/**
     * @var BookLayout
     */
    protected $_booklayout;
    protected $_fileUploaderFactory;
    protected $_filesystem;
    protected $logger;
    protected $uploaderFactory;
    protected $adapterFactory;

    public function __construct(
		Context $context,
        BookLayoutFactory $booklayout,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Psr\Log\LoggerInterface $logger,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        DirectoryList $directoryList
    ) {
        $this->_booklayout = $booklayout;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
        $this->logger = $logger;
        $this->directoryList = $directoryList;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        parent::__construct($context);
    }
	public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $booklayout = $this->_booklayout->create();
        
        if($data['name']) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $url = $_POST['url'];
            $phoneno = $_POST['mobile_number'];
            $height = $_POST['height'];
            $width = $_POST['width'];
            $entid = $_POST['entid'];
            $images = $this->getRequest()->getFiles('image');

            $i = 0;
            $imagedata = "";
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                foreach ($images as $files) 
                {
                    // echo '<pre>'; print_r($images[$i]); die();
                    // try{
                            
                        //     $uploaderFactory = $this->uploaderFactory->create(['fileId' => $files['image']]);
                        //     // echo '1234'; die();
                        //     $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        //     $imageAdapter = $this->adapterFactory->create();
                        //     $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                        //     $uploaderFactory->setAllowRenameFiles(true);
                        //     $uploaderFactory->setFilesDispersion(true);
                        //     $mediaDirectory = $this->_filesystem->getDirectoryRead($this->directoryList::MEDIA);
                        //     $destinationPath = $mediaDirectory->getAbsolutePath('magneto/booklayout');
                        //     $result = $uploaderFactory->save($destinationPath);
                        //     if (!$result) {
                        //         throw new LocalizedException(
                        //             __('File cannot be saved to path: $1', $destinationPath)
                        //         );
                        //     }
                            
                        //     $imagedata = 'magneto/booklayout'.$result['file'];
                        // } catch (\Exception $e) {
                        //     $this->logger->critical($e->getMessage());
                        // }
                    
                    if (isset($files['tmp_name']) && strlen($files['tmp_name']) > 0) 
                    {
                        $uploader = $this->_fileUploaderFactory->create(['fileId' => 'image['.$i.']']);
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploader->setAllowRenameFiles(true);
                        $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('images/');
                        $data['images'] = $files['tmp_name'];
                        $result = $uploader->save($path);
                        $image = $result['file'];
                        $imagedata .=  $image.",";
                    }
                    $i++;
                }
            }
            $img = substr(trim($imagedata),0,-1);
            $booklayout->setImage($img);
            $booklayout->setName($name);
            $booklayout->setEmail($email);
            $booklayout->setMobileNumber($phoneno);
            $booklayout->setHeight($height);
            $booklayout->setWidth($width);
            $booklayout->setProductId($entid);
            if($modelId = $booklayout->save()->getId()){
                $this->messageManager->addSuccessMessage(__('You saved the data.'));
            }else{
                $this->messageManager->addErrorMessage(__('Data was not saved.'));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($url);
        return $resultRedirect;
    }
}
