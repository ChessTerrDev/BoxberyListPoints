SET check_function_bodies = false;

DROP VIEW IF EXISTS "viewProperties", "viewCountries", "viewAreas", "viewCities", "viewMetro", "viewWorkShedule", "viewAddresses", "viewGPS", "viewPhotos", "viewListPointsShort", "viewListPointsFull";
DROP TABLE IF EXISTS "ListPoints","Countries","Addresses","Areas","Cities","Metro","Properties","WorkShedule","GPS","Photos";


CREATE TABLE "ListPoints"
(
    id             serial                NOT NULL,
    "Code"         character varying(90) NOT NULL,
    "TerminalCode" character varying(90),
    "Name"         character varying(150),
    "Organization" character varying(150),
    "ZipCode"      integer,
    "CountryCode"  integer               NOT NULL,
    "Area"         integer               NOT NULL,
    "City"         integer               NOT NULL,
    "Address"      integer               NOT NULL,
    "GPS"          integer               NOT NULL,
    "Properties"   integer               NOT NULL,
    "Phone"        character varying(90),
    "WorkShedule"  integer               NOT NULL,
    "UpdateDate"   date                  NOT NULL,
    "Active"       bool DEFAULT true,
    "Deleted"      bool DEFAULT false,
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
    id                serial  NOT NULL,
    "Street"          character varying(150),
    "House"           character varying(110),
    "Structure"       character varying(110),
    "Housing"         character varying(110),
    "Apartment"       character varying(110),
    "AddressFull"     text,
    "AddressReduce"   text,
    "TripDescription" text,
    "Cities_id"       integer NOT NULL,
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
    ADD CONSTRAINT "ListPoints_Area_fkey"
        FOREIGN KEY ("Area") REFERENCES "Areas" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_City_fkey"
        FOREIGN KEY ("City") REFERENCES "Cities" (id);

ALTER TABLE "Metro"
    ADD CONSTRAINT "Metro_City_id_fkey"
        FOREIGN KEY ("City_id") REFERENCES "Cities" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_Address_fkey"
        FOREIGN KEY ("Address") REFERENCES "Addresses" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_GPS_fkey" FOREIGN KEY ("GPS") REFERENCES "GPS" (id)
;

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_Properties_fkey"
        FOREIGN KEY ("Properties") REFERENCES "Properties" (id);

ALTER TABLE "ListPoints"
    ADD CONSTRAINT "ListPoints_WorkShedule_fkey"
        FOREIGN KEY ("WorkShedule") REFERENCES "WorkShedule" (id);

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

ALTER TABLE "Addresses"
    ADD CONSTRAINT "Addresses_Cities_id_fkey"
        FOREIGN KEY ("Cities_id") REFERENCES "Cities" (id);
