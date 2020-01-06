<?php


class Config
{
    const URL = 'dev.cms.system';
    const PROTOCOL = 'http';
    const HIDE_LANG = false;

    //region Language

    const DEFAULT_LANGUAGE = "tr";

    //endregion

    //region Alerts

    const ALERT_LOGIN_ATTEMPT = 5;

    //endregion

    //region Paths

    const PATH_UPLOAD_DOCUMENT = "/upload/document/";

    //endregion

    //region Mail

    const MAIL_SEND_TRY = 3;
    const MAIL_SEND_COUNT = 2; //todo
    const MAIL_SERVER = "smtp.gmail.com";
    const MAIL_PORT = 587;
    const MAIL_LOGIN = "noreply.set2020@gmail.com";
    const MAIL_PASSWORD = "123set2020";
    const MAIL_FROM_NAME = "Muhammed Kalender";

    //endregion
}