# import dependencies
import subprocess
import json
from dominate import document
from dominate.tags import *

# run phpmd & sanatise results
_result = json.loads(subprocess.run(args=['php', './phpmd/phpmd.phar', './input', 'json', 'controversial'], capture_output=True).stdout)
result = {}
# for every reported file
for file in _result['files']:
    _r = result.get(file['file']) or []
    # for every reported violation
    for violation in file['violations']: 
        r = {}
        r['linter'] = "PHPMD - Controversial Ruleset"
        r['line'] = violation['beginLine']
        r['message'] = violation['description']
        _r.append(r)
    result[file['file']] = _r

# run phpstan & sanatise results
_result = json.loads(subprocess.run(args=['php', './phpstan/phpstan.phar', 'analyse', './input', '--error-format=json', '--no-progress', '--level', 'max'], capture_output=True).stdout)
print(result.keys())
# for every reported file
for key in _result['files'].keys():
    _r = result.get(key) or []
    # for every reported violation
    for violation in _result['files'][key]['messages']:
        r['linter'] = "PHPStan - MAX Level"
        r['line'] = violation['line']
        r['message'] = violation['message']
        _r.append(r)
    result[key] = _r

# generate html results
with document(title='LINT Result') as doc:
    with doc.head:
        meta(charset="utf-8")
        meta(name="viewport", content="width=device-width, initial-scale=1")
        link(rel='stylesheet', href='style.css')
        link( rel="stylesheet", href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css", integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2", crossorigin="anonymous")
    h1('Results' , _class="container")
    # for every reported file
    for _file in result.keys():
        file = result[_file]
        file.sort(key=lambda x: x['line'])
        d = [h5("Linted File:  " , _file)]
        prev = False
        # for every reported violation
        for violation in file:
            if (prev and prev['line'] == violation['line'] and prev['message'] == violation['message']): continue
            prev = violation
            d.append(\
                div([\
                    div([\
                        span(violation['linter'], _class='linter'),\
                        span(violation['line'], _class='lineBegin')
                    ], _class='col-md-6'),\
                    div([\
                        span(violation['message'], _class='content')\
                    ], _class='col-md-6')\
                ], _class='row')\
            )
            # legacy system
            #d.append(\
            #    div([\
            #        div([\
            #            span(violation['beginLine'],_class='lineBegin'),\
            #            span(violation['endLine'],_class='lineEnd')\
            #        ], _class='lines'),\
            #        div([\
            #            span(violation['class'],_class='nameClass'),\
            #            span(violation['method'],_class='nameMethod'),\
            #            span(violation['function'] or '',_class='nameFunction')\
            #        ], _class='source'),\
            #        div([\
            #            span(violation['ruleSet'],_class='nameRuleSet'),\
            #            span(violation['rule'],_class='nameRule'),\
            #            p(violation['description'],_class='content')\
            #        ], _class='violation')\
            #    ], _class='fullViolation')\
            #)
        div(d, _class='container')

# write result to file
with open('output/out.html', 'w') as f:
    f.write(doc.render())