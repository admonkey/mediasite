-- users
-- all passwords are Password1
INSERT INTO `Users` (username,email,first_name,last_name,private,password,salt)
  VALUES (
    'john','john@example.com','John','Doe',0,
    '4ec69650aee849fdf9eabac27dc7f19c5428c06c3b9ba7823c44e4ca18d92f55151d298e8a2e9e4407dc77adb4fe03cdcf615bca2ae8284f199f9cc3848fa03f',
    '7a30d6b8697637b57f4510046de55406f1e194ddefab5c5794ec3193a1f4f31947f037dc082c5d5b720dd3855b2d9a5594b241545ed1c405196b8079ab5f47e0'
  ),(
    'jane','jane@example.com','Jane','Doe',0,
    'e048ff6292e4db35369d1b855dafb677cb16f7fbbe8bb75a90ea7a34209f8d8e6121e85ba5f5b924089b221bb8e29d5211791b7b97cbedf2a09e51a0526afb7f',
    '215da1d50587b63aed0b44a96c4745a6cf54430ca70fd253eae79d709f4b82dcad4a2e5d15f981643594e00fcaa512843c32ec70450dc1b5df7da81fd88c2553'
  ),(
    'jeff','jeff@example.com','Jeff','Doe',0,
    '061e6e90034b09b0327dec4e68f0ad748f451bda022ea3561d707b64a940f0b40da32579fa8b2446be7f71c1e93cfedbdbf2c8f2dc1eaccae02c76cfd1ccb854',
    '5b54c9c0b7f8dd375b66b4bb12878b97f9c48b9f9a1425a87d6137fe4fd0785936cf8c6609dc24c766cfa287fe8c302f9b4574bddc5bb7737f7773806baecbf7'
  ),(
    'joe','joe@example.com','Joe','Doe',1,
    '3cf9c793c015e18d15beae178b27b307a9f8bc4eaff71027f0767c81ed000a8067f62a2edd41db236ee4b7edfc946f2c03e1f8544a530e66539ea55480973e9a',
    '207bd453c815e0a12fa8ec37079c9fb8dac7e06984ffdf996fa934bb6e89bda413e08f0c3017670386925ccb08b00e966f965bc2ce1cce98f49071b35c902cf3'
  ),(
    'josephina','josephina@example.com','Josephina','Doe',1,
    '77eca0d10f2f93b562440e1c50630ec201db0cce09fad4cd7ab5f2956854fab6471005bbdc7a3dd04753febbf2102ba7078ec07ef17df0360fc983296def8265',
    '8123b98724b4c9e7fd35741d086bc2be11ec7158915799b092bad4c7f0f38cc184b55be47cf10c64fa0475d3355a6c253036fa73d89eadb1fefaadba9ecce722'
  ),(
    'jose','jose@example.com','Jose','Doe',0,
    'c0d6561b1b26eb9f780b1abb12e4740e1b4b8a2c6871d12cb8b2dbd6d3854aabb258b82d33fd542f0606a16b039e801c45125f747f735790adec80f31f047a68',
    'd9e44eb95d1a1c626ef5f3757a91dd7a710f0bceba8c74a6b8b65082e8b94e065fddd3fbeb715fccf86060837c5be4ee5d815915375aa1197dae997010302559'
  );

-- user groups
INSERT INTO `User_Groups` (group_name,group_createdby_user_id) VALUES ('GUYS',2);
INSERT INTO `User_Groups` (group_name,group_createdby_user_id) VALUES ('GIRLS',3);

-- user-group links
-- admin
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (4,1);
-- guys
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (2,2);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (4,2);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (5,2);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (7,2);
-- girls
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (3,3);
INSERT INTO `User_Groups-link` (user_id,group_id) VALUES (6,3);
