<?php namespace Dpl\Bgtaxi\Components;

use Cms\Classes\ComponentBase;
use Dpl\Bgtaxisettings\Models\BgtaxiSettings;
use Dpl\Pintel\Models\Content;
use Input;
use Mail;

class MailComponent extends ComponentBase
{

    const CONTACT_US_TEMPLATE = 'dpl.bgtaxi::emails.contact_us';

    public function componentDetails()
    {
        return [
            'name'        => 'Mail component',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onContactUs() {
        $arData = Input::all();
        if(empty($arData)) {
            return;
        }
        $arSendData = [];
        foreach ($arData as $k => $arField) {
            $arSendData[$k] = $arField;
        }
        $arSendTo = explode(',', BgtaxiSettings::get('contact_emails'));
        $sTemplate = self::CONTACT_US_TEMPLATE;
        $this->mailSend($sTemplate, $arSendData, $arSendTo);
    }

    public function mailSend($sTemplate, $arData, $arSendTo){
        if(empty($arSendTo)){
            return;
        }
        Mail::send($sTemplate, $arData, function($message) use ($arSendTo, $arData) {
            $message->to($arSendTo);
            $message->from($arData['email']);
        });
        return response()->json();
    }

}