<?php declare(strict_types=1);

namespace Criterja\s2j;

class RestApiV3Service implements JiraApiService {

    public function getAcceptanceCriteriaFieldId() {
        // make a call to <url>/rest/api/field
        // here is the response
        /*
            {
            "untranslatedName" : "Acceptance Criteria",
            "schema" : {
                "customId" : 10033,
                "type" : "string",
                "custom" : "com.atlassian.jira.plugin.system.customfieldtypes:textarea"
            },
            "name" : "Acceptance Criteria",
            "clauseNames" : [
                "Acceptance Criteria",
                "Acceptance Criteria[Paragraph]",
                "cf[10033]"
            ],
            "key" : "customfield_10033",
            "orderable" : true,
            "searchable" : true,
            "scope" : {
                "type" : "PROJECT",
                "project" : {
                    "id" : "10000"
                }
            },
            "custom" : true,
            "navigable" : true,
            "id" : "customfield_10033"
        }
        */
        // return the id.
    }

    public function updateIssue() {
        //make a call like the following
        /*
        curl --request PUT \
        --url 'https://your-domain.atlassian.net/rest/api/3/issue/{issueIdOrKey}' \
        --user 'email@example.com:<api_token>' \
        --header 'Accept: application/json' \
        --header 'Content-Type: application/json' \
        --data '{
        "fields": {
            "customfield_10000": {
            "content": [
                {
                "content": [
                    {
                    "text": "Investigation underway",
                    "type": "text"
                    }
                ],
                "type": "paragraph"
                }
            ],
            "type": "doc",
            "version": 1
            },
            "customfield_10010": 1,
            "summary": "Completed orders still displaying in pending"
        },
        "historyMetadata": {
            "activityDescription": "Complete order processing",
            "actor": {
            "avatarUrl": "http://mysystem/avatar/tony.jpg",
            "displayName": "Tony",
            "id": "tony",
            "type": "mysystem-user",
            "url": "http://mysystem/users/tony"
            },
            "cause": {
            "id": "myevent",
            "type": "mysystem-event"
            },
            "description": "From the order testing process",
            "extraData": {
            "Iteration": "10a",
            "Step": "4"
            },
            "generator": {
            "id": "mysystem-1",
            "type": "mysystem-application"
            },
            "type": "myplugin:type"
        },
        "properties": [
            {
            "key": "key1",
            "value": "Order number 10784"
            },
            {
            "key": "key2",
            "value": "Order number 10923"
            }
        ],
        "update": {
            "components": [
            {
                "set": ""
            }
            ],
            "labels": [
            {
                "add": "triaged"
            },
            {
                "remove": "blocker"
            }
            ],
            "summary": [
            {
                "set": "Bug in business logic"
            }
            ],
            "timetracking": [
            {
                "edit": {
                "originalEstimate": "1w 1d",
                "remainingEstimate": "4d"
                }
            }
            ]
        }
        }'
        
        */
    }
}