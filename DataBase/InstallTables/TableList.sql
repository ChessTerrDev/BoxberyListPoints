SET check_function_bodies = false;

DROP VIEW IF EXISTS "viewProperties", "viewCountries", "viewAreas", "viewCities", "viewMetro", "viewWorkShedule", "viewAddresses", "viewGPS", "viewPhotos", "viewListPointsShort", "viewListPointsFull";
DROP TABLE IF EXISTS "ListPoints","Countries","Addresses","Areas","Cities","Metro","Properties","WorkShedule","GPS","Photos";

CREATE TABLE "ListPoints"
(
    id               serial                NOT NULL,
    "Code"           character varying(90) NOT NULL,
    "TerminalCode"   character varying(90),
    "Name"           character varying(150),
    "Organization"   character varying(150),
    "ZipCode"        integer,
    "CountryCode"    integer               NOT NULL,
    "Area_id"        integer               NOT NULL,
    "City_id"        integer               NOT NULL,
    "Address_id"     integer               NOT NULL,
    "GPS_id"         integer               NOT NULL,
    "Property_id"    integer               NOT NULL,
    "Phone"          character varying(90),
    "WorkShedule_id" integer               NOT NULL,
    "UpdateDate"     date                  NOT NULL,
    "Active"         bool DEFAULT true,
    "Deleted"        bool DEFAULT false,
    CONSTRAINT "ListPoints_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Countries"
(
    "CountryCode" integer NOT NULL,
    "CountryName" character varying(70),
    CONSTRAINT "Countries_pkey" PRIMARY KEY ("CountryCode")
);

CREATE TABLE "Addresses"
(
    id                serial NOT NULL,
    "Street"          character varying(150),
    "House"           character varying(110),
    "Structure"       character varying(110),
    "Housing"         character varying(110),
    "Apartment"       character varying(110),
    "AddressFull"     text,
    "AddressReduce"   text,
    "TripDescription" text,
    CONSTRAINT "Addresses_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Areas"
(
    id            serial  NOT NULL,
    "Name"        character varying(150),
    "CountryCode" integer NOT NULL,
    CONSTRAINT "Areas_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Cities"
(
    id           serial  NOT NULL,
    "Name"       character varying(150),
    "Settlement" character varying(150),
    "Area_id"    integer NOT NULL,
    CONSTRAINT "Cities_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Metro"
(
    id              serial  NOT NULL,
    "City_id"       integer NOT NULL,
    "MetroName"     character varying(90),
    "ListPoints_id" integer NOT NULL,
    CONSTRAINT "Metro_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Properties"
(
    id                        serial NOT NULL,
    "ForeignOnlineStoresOnly" bool,
    "PrepaidOrdersOnly"       bool,
    "Acquiring"               bool,
    "DigitalSignature"        bool,
    "TypeOfOffice"            int2    DEFAULT 0,
    "CourierDelivery"         bool,
    "Reception"               bool,
    "ReceptionLaP"            bool,
    "DeliveryLaP"             bool,
    "LoadLimit"               numeric DEFAULT 0,
    "VolumeLimit"             numeric DEFAULT 0,
    "EnablePartialDelivery"   bool,
    "EnableFitting"           bool,
    "fittingType"             integer DEFAULT 0,
    "NalKD"                   bool,
    "TransType"               integer DEFAULT 0,
    "InterRefunds"            bool,
    "ExpressReception"        bool,
    "Terminal"                bool,
    "IssuanceBoxberry"        bool,
    CONSTRAINT "Properties_pkey" PRIMARY KEY (id)
);

CREATE TABLE "WorkShedule"
(
    id                 serial NOT NULL,
    "ShortWorkShedule" character varying(150),
    "WorkMoBegin"      time,
    "WorkMoEnd"        time,
    "WorkTuBegin"      time,
    "WorkTuEnd"        time,
    "WorkWeBegin"      time,
    "WorkWeEnd"        time,
    "WorkThBegin"      time,
    "WorkThEnd"        time,
    "WorkFrBegin"      time,
    "WorkFrEnd"        time,
    "WorkSaBegin"      time,
    "WorkSaEnd"        time,
    "WorkSuBegin"      time,
    "WorkSuEnd"        time,
    "LunchMoBegin"     time,
    "LunchMoEnd"       time,
    "LunchTuBegin"     time,
    "LunchTuEnd"       time,
    "LunchWeBegin"     time,
    "LunchWeEnd"       time,
    "LunchThBegin"     time,
    "LunchThEnd"       time,
    "LunchFrBegin"     time,
    "LunchFrEnd"       time,
    "LunchSaBegin"     time,
    "LunchSaEnd"       time,
    "LunchSuBegin"     time,
    "LunchSuEnd"       time,
    "ScheduleJSON"     json,
    CONSTRAINT "WorkShedule_pkey" PRIMARY KEY (id)
);

CREATE TABLE "GPS"
(
    id        serial NOT NULL,
    latitude  float4,
    longitude float4,
    CONSTRAINT "GPS_pkey" PRIMARY KEY (id)
);

CREATE TABLE "Photos"
(
    id             serial  NOT NULL,
    "PhotoLink"    text,
    "ListPoint_id" integer NOT NULL,
    CONSTRAINT "Photos_pkey" PRIMARY KEY (id)
);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_CountryCode_fkey"
        FOREIGN KEY ("CountryCode") REFERENCES "Countries" ("CountryCode");

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_Area_id_fkey"
        FOREIGN KEY ("Area_id") REFERENCES "Areas" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_City_id_fkey"
        FOREIGN KEY ("City_id") REFERENCES "Cities" (id);

ALTER TABLE "Metro"
    ADD CONSTRAINT "Metro_City_id_fkey"
        FOREIGN KEY ("City_id") REFERENCES "Cities" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_Address_id_fkey"
        FOREIGN KEY ("Address_id") REFERENCES "Addresses" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_GPS_id_fkey"
        FOREIGN KEY ("GPS_id") REFERENCES "GPS" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_Property_id_fkey"
        FOREIGN KEY ("Property_id") REFERENCES "Properties" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_WorkShedule_id_fkey"
        FOREIGN KEY ("WorkShedule_id") REFERENCES "WorkShedule" (id);

ALTER TABLE "Photos"
    ADD CONSTRAINT "Photos_ListPoint_id_fkey"
        FOREIGN KEY ("ListPoint_id") REFERENCES "ListPoints" (id);

ALTER TABLE "Areas"
    ADD CONSTRAINT "Areas_CountryCode_fkey"
        FOREIGN KEY ("CountryCode") REFERENCES "Countries" ("CountryCode");

ALTER TABLE "Cities"
    ADD CONSTRAINT "Cities_Area_id_fkey"
        FOREIGN KEY ("Area_id") REFERENCES "Areas" (id);

ALTER TABLE "Metro"
    ADD CONSTRAINT "Metro_ListPoints_id_fkey"
        FOREIGN KEY ("ListPoints_id") REFERENCES "ListPoints" (id);

CREATE VIEW "viewProperties" AS
SELECT list."Code",
       list."Name",
       list."ZipCode",
       prop."ForeignOnlineStoresOnly",
       prop."PrepaidOrdersOnly",
       prop."Acquiring",
       prop."DigitalSignature",
       prop."TypeOfOffice",
       prop."CourierDelivery",
       prop."Reception",
       prop."ReceptionLaP",
       prop."DeliveryLaP",
       prop."LoadLimit",
       prop."VolumeLimit",
       prop."EnablePartialDelivery",
       prop."EnableFitting",
       prop."fittingType",
       prop."NalKD",
       prop."TransType",
       prop."InterRefunds",
       prop."ExpressReception",
       prop."Terminal",
       prop."IssuanceBoxberry"
FROM "ListPoints" list
         LEFT OUTER JOIN "Properties" prop ON list."Property_id" = prop."id";



CREATE VIEW "viewCountries" AS
SELECT list."Code", list."ZipCode", cnr."CountryCode", cnr."CountryName"
FROM "ListPoints" list
         LEFT OUTER JOIN "Countries" cnr ON list."CountryCode" = cnr."CountryCode";

CREATE VIEW "viewAreas" AS
SELECT list."Code", list."ZipCode", area."Name", cnr."CountryCode", cnr."CountryName"
FROM "ListPoints" list
         LEFT OUTER JOIN "Areas" area ON list."Area_id" = area.id
         LEFT OUTER JOIN "Countries" cnr ON cnr."CountryCode" = area."CountryCode";

CREATE VIEW "viewCities" AS
SELECT list."Code",
       list."ZipCode",
       city."Name",
       city."Settlement",
       area."Name" as "AreaName",
       cnr."CountryCode",
       cnr."CountryName"
FROM "ListPoints" list
         LEFT OUTER JOIN "Cities" city ON list."City_id" = city.id
         LEFT OUTER JOIN "Areas" area ON city."Area_id" = area.id
         LEFT OUTER JOIN "Countries" cnr ON cnr."CountryCode" = area."CountryCode";

CREATE VIEW "viewWorkShedule" AS
SELECT wsh.*, list."Code", list."ZipCode"
FROM "ListPoints" list
         LEFT OUTER JOIN "WorkShedule" wsh ON list."WorkShedule_id" = wsh.id;

CREATE VIEW "viewAddresses" AS
SELECT addr.*, list."Code", list."ZipCode"
FROM "ListPoints" list
         LEFT OUTER JOIN "Addresses" addr ON list."Address_id" = addr.id;

CREATE VIEW "viewGPS" AS
SELECT gps.*, list."Code", list."ZipCode"
FROM "ListPoints" list
         LEFT OUTER JOIN "GPS" gps ON list."GPS_id" = gps.id;

CREATE VIEW "viewListPointsShort" AS
SELECT "Code", "TerminalCode", "Name", "Organization", "ZipCode", "UpdateDate"
FROM "ListPoints";

CREATE VIEW "viewListPointsFull" AS
SELECT list."Code",
       list."TerminalCode",
       list."Name",
       list."Organization",
       list."ZipCode",
       list."Area_id",
       list."City_id",
       list."Address_id",
       list."GPS_id",
       list."Property_id",
       list."Phone",
       list."WorkShedule_id",
       list."UpdateDate",
       list."Active",
       list."Deleted",
       property."ForeignOnlineStoresOnly",
       property."PrepaidOrdersOnly",
       property."Acquiring",
       property."DigitalSignature",
       property."TypeOfOffice",
       property."CourierDelivery",
       property."Reception",
       property."ReceptionLaP",
       property."DeliveryLaP",
       property."LoadLimit",
       property."VolumeLimit",
       property."EnablePartialDelivery",
       property."EnableFitting",
       property."fittingType",
       property."NalKD",
       property."TransType",
       property."InterRefunds",
       property."ExpressReception",
       property."Terminal",
       property."IssuanceBoxberry",
       addr."Street",
       addr."House",
       addr."Structure",
       addr."Housing",
       addr."Apartment",
       addr."AddressFull",
       addr."AddressReduce",
       addr."TripDescription",
       wsh."ShortWorkShedule",
       wsh."WorkMoBegin",
       wsh."WorkMoEnd",
       wsh."WorkTuBegin",
       wsh."WorkTuEnd",
       wsh."WorkWeBegin",
       wsh."WorkWeEnd",
       wsh."WorkThBegin",
       wsh."WorkThEnd",
       wsh."WorkFrBegin",
       wsh."WorkFrEnd",
       wsh."WorkSaBegin",
       wsh."WorkSaEnd",
       wsh."WorkSuBegin",
       wsh."WorkSuEnd",
       wsh."LunchMoBegin",
       wsh."LunchMoEnd",
       wsh."LunchTuBegin",
       wsh."LunchTuEnd",
       wsh."LunchWeBegin",
       wsh."LunchWeEnd",
       wsh."LunchThBegin",
       wsh."LunchThEnd",
       wsh."LunchFrBegin",
       wsh."LunchFrEnd",
       wsh."LunchSaBegin",
       wsh."LunchSaEnd",
       wsh."LunchSuBegin",
       wsh."LunchSuEnd",
       wsh."ScheduleJSON",
       ctr."CountryCode",
       ctr."CountryName",
       area."Name" AS "AreaName",
       city."Name" AS "CityName",
       city."Settlement",
       gps."latitude",
       gps."longitude"
FROM "ListPoints" list
         LEFT OUTER JOIN "Properties" property ON list."Property_id" = property.id
         LEFT OUTER JOIN "Addresses" addr ON list."Address_id" = addr.id
         LEFT OUTER JOIN "WorkShedule" wsh ON list."WorkShedule_id" = wsh.id
         LEFT OUTER JOIN "Countries" ctr ON list."CountryCode" = ctr."CountryCode"
         LEFT OUTER JOIN "Areas" area ON list."Area_id" = area.id
         LEFT OUTER JOIN "Cities" city ON list."City_id" = city.id
         LEFT OUTER JOIN "GPS" gps ON list."GPS_id" = gps.id
;
